<?php
interface NotifyTypeIntercafe
{
    public function sendNotify(string $msg): void;
}
class Notify
{
    public function __construct(string $type, string | array $msg)
    {
        $notification = NotifyFactory::createNotify($type); 
        return $notification->sendNotify($msg);
    }
}
class NotifyFactory
{
    public static function createNotify(string $type) : NotifyTypeIntercafe
    {
        switch ($type) {
            case 'sms':
                return new NotifySms;
                break;
            case 'whats':
                return new NotifyWhats;
                break;
            case 'email':
                return new NotifyEmail;
                break;

            default:
                return null;
                break;
        }
    }
}
class NotifyWhats implements NotifyTypeIntercafe{
    public function sendNotify(string $msg): void
    {
        echo "NotifyWhats: ". $msg;
    }
}
class NotifyEmail implements NotifyTypeIntercafe{
    public function sendNotify(string $msg): void
    {
        echo "NotifyEmail: ". $msg;
    }
}
class NotifySms implements NotifyTypeIntercafe{
    public function sendNotify(string $msg): void
    {
        echo "NotifySms: ". $msg;
    }
}