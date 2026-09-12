<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->subject('Your Verification Code - Synergy Modular Homes')
                    ->html("
                        <div style='font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto; padding: 20px; border: 1px solid #e2e8f0; border-radius: 12px;'>
                            <h2 style='color: #0B1C33; text-align: center;'>Email Verification</h2>
                            <p style='color: #475569; font-size: 15px;'>Thank you for registering with Synergy Modular Homes. Use the verification code below to complete your registration:</p>
                            <div style='background-color: #f8fafc; border: 2px dashed #B87333; border-radius: 8px; padding: 15px; text-align: center; margin: 20px 0;'>
                                <span style='font-size: 32px; font-weight: bold; letter-spacing: 6px; color: #B87333;'>{$this->otp}</span>
                            </div>
                            <p style='color: #64748b; font-size: 13px;'>This code is valid for 10 minutes. If you did not request this, please ignore this email.</p>
                        </div>
                    ");
    }
}
