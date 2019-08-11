<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewSchoolInvite extends Notification
{
    use Queueable;

    public $user;
    public $school;
    public $invite;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $school, $invite)
    {
        $this->user = $user;
        $this->school = $school;
        $this->invite = $invite;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'user_uid' => $this->user->uid,
            'user_name' => $this->user->name,
            'school_name' => $this->school->name,
            'school_id' => $this->school->id,
            'invite_id' => $this->invite->id,
        ];
    }
}
