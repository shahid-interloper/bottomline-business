<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use App\Notifications\AdminNotification;
use App\Notifications\SMSNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Mail;


// use Omnipay\Omnipay;

class FrontendController extends Controller
{

    // private $gateway;
    // public function __construct()
    // {
    //     $this->gateway = Omnipay::create('PayPal_Rest');
    //     $this->gateway->setClientId(config('app.paypalClientId'));
    //     $this->gateway->setSecret(config('app.payPalClientSecret'));
    //     $this->gateway->setTestMode(true); //set it to 'false' when go live

    // }
    // private $totalAmount = 449;
    private $totalAmount = 2;
    private $calculatedAmount = 0;

    public function index()
    {
        return redirect()->route('home');
    }


    public function registerStep1()
    {
        return view('frontend.register-step1');
    }


    public function registerStep1Process(Request $request)
    {
        $request->session()->put('dates', trim($request->dates));
        $dates = explode(',', $request->session()->get('dates'));
        if (count($dates) > 2 || count($dates) < 2) {
            return redirect()->route('front.register.step1')->with(['message' => 'please select two dates', 'type' => 'danger']);
        }

        $course = Course::where('start_date', trim($dates[0]))->where('end_date', trim($dates[1]))->first();
        // dd($check);
        if (!empty($course)) {
            $studentsCount = Student::where('course_id', $course->id)->get()->count();
            $remainingStudents = 50 - $studentsCount;
        } else {
            $remainingStudents = 50;
        }
        return redirect()->route('front.register.step2')->with('remainingStudents', $remainingStudents);
    }

    public function registerStep2(Request $request)
    {
        if (!session::has('dates')) {
            return redirect()->route('front.register.step1')->with(['message' => 'please select two dates', 'type' => 'danger']);
        }
        return view('frontend.register-step2');
    }

    public function registerStep2Process(Request $request)
    {
        $request->validate(
            [
                'student.*.first_name' => 'required',
                'student.*.phone' => 'required',
                'student.*.email' => 'required',

            ],
            [
                'student.*.first_name.required'  => 'The first name is required',
                'student.*.phone.required'       => 'The phone number is required',
                'student.*.phone.regex'          => 'phone number format is invalid',
                'student.*.phone.unique'         => 'phone number is already taken',
                'student.*.email'                => 'email should be proper email address',

            ]
        );

        if (count($request->student) > 50) {
            return redirect()->route('front.register.step2')->with(['message' => 'You can Only add 50 students in a class', 'type' => 'danger']);
        }
        $request->session()->put('students', $request->student);
        $amount = count($request->student) * $this->totalAmount;
        // dd($amount);
        return view('frontend.checkout', compact('amount'));
    }

    public function checkStudents(Request $request)
    {
        //  dd($request->all());
        $dates = explode(',', $request->session()->get('dates'));
        $course = Course::where('start_date', trim($dates[0]))->where('end_date', trim($dates[1]))->first();
        $data = 0;
        if (!empty($course)) {
            $count = Student::where('course_id', $course->id)->count();
            $count = $count + $request->number_of_students;
            if ($count > 50) {
                $data =  "Course Limit Exceeds ( ONly 50 students are allowed in a course )  Please try in another available course";
            }
        } else {
            $data =  '50 students are available in a course';
        }

        return json_encode($data);
    }

    public function addStudents(Request $request)
    {
        $messageBody = "You are registered to attend a 2-day Customer Service Training event with the Bottomline Business Solutions team on ".session()->get('dates')." You are registered to attend this important workshop for professional development or because your employer values you as an employee. The Specifics of your training day is noted below: *Each registrant must bring examples of good and bad customer service experiences! Class: - 2-day Good ‘Ole Fashioned Customer Service Training Dates: ".session()->get('dates')." Time: 9:00 a.m. to 4:00 p.m";

        $studentsCount = count($request->session()->get('students'));
        $pricePerStudent = $this->totalAmount;
        $this->calculatedAmount = ($pricePerStudent * $studentsCount);

        if ($this->calculatedAmount < ($pricePerStudent * $studentsCount)) {
            return redirect()->route('user.dashboard')->with(['message' => 'Price can not be less than total number of students', 'type' => 'danger']);
        }

        // dd($request->payment_token);

        // SAVING DATES 
        $dates = explode(',', $request->session()->get('dates'));
        $course = new Course();
        $course->user_id     = Auth::id();
        $course->start_date  = @trim($dates[0]);
        $course->end_date    = @trim($dates[1]);

        // $courses = Course::all();
        $checkCourse = Course::where('start_date', trim($dates[0]))->where('end_date', trim($dates[1]))->first();
        if (!empty($checkCourse)) {
            $count = Student::where('course_id', $checkCourse->id)->count();
            if ($count >= 50) {
                return redirect()->route('front.register.step1')->with(['message' => 'Course Limit Exceeds ( ONly 50 students are allowed in a course )  Please try in another available course', 'type' => 'danger']);
            } else {
                $cardNumber = $request->input('card_number');
                $expirationDate = $request->input('expiration_date');
                $cvv = $request->input('cvv');

                $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
                $merchantAuthentication->setName(config('app.API_LOGIN_ID'));
                $merchantAuthentication->setTransactionKey(config('app.TRANSACTION_KEY'));

                $creditCard = new AnetAPI\CreditCardType();
                $creditCard->setCardNumber($cardNumber);
                $creditCard->setExpirationDate($expirationDate);
                $creditCard->setCardCode($cvv);

                $payment = new AnetAPI\PaymentType();
                $payment->setCreditCard($creditCard);


                $customerAddress = new AnetAPI\CustomerAddressType();
                $customerAddress->setFirstName(@$request->fname);
                $customerAddress->setLastName(@$request->lname);
                $customerAddress->setAddress(@$request->line_one);
                $customerAddress->setAddress(@$request->line_two);
                $customerAddress->setCity(@$request->city);
                $customerAddress->setState(@$request->state);
                $customerAddress->setZip(@$request->zip);
                $customerAddress->setCountry("USA");



                $transactionRequestType = new AnetAPI\TransactionRequestType();
                $transactionRequestType->setTransactionType("authCaptureTransaction");
                $transactionRequestType->setAmount(@$this->calculatedAmount);
                $transactionRequestType->setPayment($payment);
                $transactionRequestType->setBillTo($customerAddress);

                $request = new AnetAPI\CreateTransactionRequest();
                $request->setMerchantAuthentication($merchantAuthentication);
                $request->setRefId("ref" . time());
                $request->setTransactionRequest($transactionRequestType);

                $controller = new AnetController\CreateTransactionController($request);
                $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

                if ($response != null) {
                    $tresponse = $response->getTransactionResponse();
                    //  dd($response, $tresponse);
                    if ($tresponse != null && $response->getMessages()->getResultCode() == "Ok") {
                        foreach (session()->get('students') as  $value) {
                            $student = new Student();
                            $student->course_id     = $checkCourse->id;
                            $student->first_name    = $value['first_name'];
                            $student->last_name     = $value['last_name'];
                            $student->email         = $value['email'];
                            $student->phone         = $value['phone'];
                            // $student->email_sent         = false;
                            $student->save();
                            try {
                                Mail::send('emails.registernotification', ['data' => $value, 'dates' => session()->get('dates')], function ($message) use ($value) {
                                    $message->to($value['email'])->subject("Student Registration");
                                });
                            } catch (\Throwable $e) {
                                Log::info($e->getCode() . ' - ' . $e->getMessage());
                            }
                            // Notification::send($value, new CourseRegisterNotification($data));
                            $curl = curl_init();
                            $headers = [
                                'Content-Type: application/json', // Example JSON header
                                'Authorization: Bearer 91463e2433d09d3ec623cfde071fdb', // Example Authorization header
                            ];
                            curl_setopt_array($curl, array(
                            CURLOPT_HTTPHEADER => $headers,
                            CURLOPT_URL => 'https://api.mobile-text-alerts.com/v3/send',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS =>'{
                                    "subscribers": ['.$value["phone"].'],
                                    "message": "Congratulations! Mr ' .$value['first_name'].'  ' .$value['last_name'].' ' .$messageBody.'"
                                }',
                            ));

                            $response = curl_exec($curl);

                            curl_close($curl);
                            
                            // echo $response;
                            // $adminData = [
                            //     'message' => 'New student has been registered',
                            //     'name'    => $value['first_name'],
                            //     'email'   => $value['email'],
                            //     'phone'   => $value['phone'],
                            // ];

                            //  $admin = User::find(5); // id 5 is admin
                            //  $admin->notify(new adminNotification($adminData));


                        }
                        $data['message'] = 'Students Registered Successfully';
                        $data['type']    = 'success';
                        session()->forget('dates');
                        return redirect()->route('front.thank.you')->with($data);
                    } else {
                        return redirect()->route('front.paymnet.failed');
                    }
                } else {
                    return redirect()->route('front.paymnet.failed');
                }
                // dd($response);


            }
        } else {
            $cardNumber = $request->input('card_number');
            $expirationDate = $request->input('expiration_date');
            $cvv = $request->input('cvv');

            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(config('app.API_LOGIN_ID'));
            $merchantAuthentication->setTransactionKey(config('app.TRANSACTION_KEY'));

            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber($cardNumber);
            $creditCard->setExpirationDate($expirationDate);
            $creditCard->setCardCode($cvv);

            $payment = new AnetAPI\PaymentType();
            $payment->setCreditCard($creditCard);
            
                $customerAddress = new AnetAPI\CustomerAddressType();
                $customerAddress->setFirstName(@$request->fname);
                $customerAddress->setLastName(@$request->lname);
                $customerAddress->setAddress(@$request->line_one);
                $customerAddress->setAddress(@$request->line_two);
                $customerAddress->setCity(@$request->city);
                $customerAddress->setState(@$request->state);
                $customerAddress->setZip(@$request->zip);
                $customerAddress->setCountry("USA");

            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("authCaptureTransaction");
            $transactionRequestType->setAmount(@$this->calculatedAmount);
            $transactionRequestType->setPayment($payment);

            $request = new AnetAPI\CreateTransactionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setRefId("ref" . time());
            $request->setTransactionRequest($transactionRequestType);

            $controller = new AnetController\CreateTransactionController($request);
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
            // dd( $response );

            if ($response != null) {
                $tresponse = $response->getTransactionResponse();
                //  dd($tresponse != null && $tresponse->getResponseCode() == "1" , $tresponse);
                // dd($tresponse != null && $response->getMessages()->getResultCode() == "Ok");
                if ($tresponse != null && $response->getMessages()->getResultCode() == "Ok") {
                    if ($course->save()) {
                        foreach (session()->get('students') as  $value) {
                            $student = new Student();
                            $student->course_id     = $course->id;
                            $student->first_name    = $value['first_name'];
                            $student->last_name     = $value['last_name'];
                            $student->email         = $value['email'];
                            $student->phone         = $value['phone'];
                            // $student->email_sent         = false;
                            $student->save();
                            try {
                                Mail::send('emails.registernotification', ['data' => $value, 'dates' => session()->get('dates')], function ($message) use ($value) {
                                    $message->to($value['email'])->subject("Student Registration");
                                });
                            } catch (\Throwable $e) {
                                Log::info($e->getCode() . ' - ' . $e->getMessage());
                            }
                            // Notification::send($value, new CourseRegisterNotification($data));
                            $curl = curl_init();
                            $headers = [
                                'Content-Type: application/json', // Example JSON header
                                'Authorization: Bearer 91463e2433d09d3ec623cfde071fdb', // Example Authorization header
                            ];
                            curl_setopt_array($curl, array(
                            CURLOPT_HTTPHEADER => $headers,
                            CURLOPT_URL => 'https://api.mobile-text-alerts.com/v3/send',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS =>'{
                                    "subscribers": ['.$value["phone"].'],
                                     "message": "Congratulations! Mr ' .$value['first_name'].'  ' .$value['last_name'].' ' .$messageBody.'"
                                    
                                }',
                            ));

                            $response = curl_exec($curl);

                            curl_close($curl);
                            // echo $response;

                        }
                        $data['message'] = 'Students Registered Successfully';
                        $data['type']    = 'success';
                        session()->forget('dates');
                        return redirect()->route('front.thank.you')->with($data);
                    }
                } else {
                    return redirect()->route('front.paymnet.failed');
                }
            } else {
                return redirect()->route('front.paymnet.failed');
            }
        }
    }


    public function paymentFailed()
    {
        $data['button_tex'] = "TRY AGAIN";
        $data['register_route'] = route('front.register.step1') ;

        return view('frontend.payment-failed', $data);
    }



    public function thankyou()
    {
        return view('frontend.thank-you');
    }


    public function SendSms()
    {

        $user = User::first();
        // dd($user);
        $user->notify(new SMSNotification);

        dd('Notification sent!');
    }
}
