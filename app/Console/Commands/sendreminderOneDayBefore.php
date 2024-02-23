<?php

namespace App\Console\Commands;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mail;
use Exception;
use Illuminate\Support\Facades\Log;

class sendreminderOneDayBefore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'student:sendreminderOneDayBefore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send email before one day of staring classes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $students = Student::join('courses', 'students.course_id', '=', 'courses.id')
            ->where(function ($query) {
                $query->where('courses.start_date', '=', Carbon::now()->addDay(2)->format('m/d/Y'));
            })->get();
            
        if ($students->count() > 0) {
         foreach ($students as $student) {
              // messageBody for sending text message
               $messageBody = "Hello $student->first_name Your scheduled 2-day Customer Service Training will start tomorrow " . $student->start_date . 'To ' . $student->end_date;

                try {
                    $isEmailSent =   Mail::send('emails.email-onedayBefore', ['data' => $student], function ($message) use ($student) {
                        $message->to($student->email)->subject("Class Reminder Alert");
                    });
                    if ($isEmailSent) {
                        $student->email_sent = true;
                        $student->save();
                    }
                } catch (Exception $e) {
                    Log::info($e->getCode() . ' - ' . $e->getMessage());
                }


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
                                "subscribers": ['.$student["phone"].'],
                                "message": "Congratulations! Mr ' .$student['first_name'].'  ' .$student['last_name'].' ' .$messageBody.'"
                            }',
                        ));

                        $response = curl_exec($curl);
                        curl_close($curl);

            }
        } else {
            Log::info('No User Found whose courses start in 1 day !..');
        }
    }
}
