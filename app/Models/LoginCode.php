<?php

namespace App\Models;

use App\Mail\RegisterUserMail;
use App\Mail\SendLoginCodeMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;

class LoginCode extends Model
{
    protected $table = 'login_codes';
    protected $fillable = ['code', 'user_id', 'used'];

    const EXPIRATION_TIME = 120;

    public function __construct(array $attributes = [])
    {
        // Ensure a code is always generated
        $attributes['code'] = $attributes['code'] ?? $this->generateCode();
        parent::__construct($attributes);
    }

    /**
     * Generate a random numeric code with a default length of 6.
     *
     * @param int $codeLength
     * @return string
     */
    public function generateCode(int $codeLength = 6): string
    {
        $min = pow(10, $codeLength - 1);
        $max = pow(10, $codeLength) - 1;
        return (string)mt_rand($min, $max);
    }

    /**
     * Define the relationship with the User model.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the token is valid (not used and not expired).
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return !$this->isUsed() && !$this->isExpired();
    }

    /**
     * Check if the token has been used.
     *
     * @return bool
     */
    public function isUsed(): bool
    {
        return (bool)$this->used;
    }

    /**
     * Check if the token has expired.
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->created_at->diffInMinutes(now()) > static::EXPIRATION_TIME;
    }

    /**
     * Send the token code to the associated user's mobile number.
     *
     * @return bool
     * @throws \Exception If no user is attached to the token.
     */
    public function sendCode($email): bool
    {
        $this->code = $this->code ?? $this->generateCode();

        try {
            $data = ['code' => $this->code];
            Mail::to($email)->send(new SendLoginCodeMail($data));
        } catch (\Exception $e) {
            dd($e);
            return false;
        }
        return true;
    }
}
