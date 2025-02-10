<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostInteractionNotification extends Notification
{
    use Queueable;

    public $user;
    public $post;
    public $action;

    public function __construct($user, $post, $action)
    {
        $this->user = $user;
        $this->post = $post;
        $this->action = $action;
    }

    public function via($notifiable)
    {
        return ['database']; // Store in database
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->user->name} has {$this->action} your post.",
            'post_id' => $this->post->id ?? null,
            'action' => $this->action
        ];
    }
}
