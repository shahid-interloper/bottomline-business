<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;

class SMSNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['vonage'];
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\VonageMessage
     */
    public function toVonage($notifiable)
    {
        return (new VonageMessage())
            ->content('Thank You for registering for “Good ‘Ole Fashioned Customer Service” training with BottomLine Business Solutions.
            You are attending this training because you are personally seeking professional development or because you are valued by your employer.
            The details of your 2-day training is as follows:
            Training Date: 
            Time: 9:00 a.m. - 4:00 p.m.
            Location: 4846 N. University Dr.       
            Sunrise, FL 33351
            ');
    }

    // /**
    //  * Get the array representation of the notification.
    //  *
    //  * @param  mixed  $notifiable
    //  * @return array
    //  */
    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'project_id' => $this->project['id']
    //     ];
    // }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
