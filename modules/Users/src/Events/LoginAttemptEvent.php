<?php
namespace Users\Events;

use Illuminate\Queue\SerializesModels;

class LoginAttemptEvent
{
    use SerializesModels;

    public $userId;
    public $success;
    public $details;

    /**
     * LoginAttemptEvent constructor.
     * @param int $userId
     * @param bool $success
     * @param string $details
     */
    public function __construct(int $userId, bool $success = true, string $details = 'Normal login')
    {
        $this->userId = $userId;
        $this->success = $success;
        $this->details = $details;
    }

    /**
     * get array representation of login attempt
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'success' => $this->success,
            'details' => $this->details
        ];
    }
}