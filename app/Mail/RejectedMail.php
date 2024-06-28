<?php

namespace App\Mail;

use App\Models\ApplicantStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class RejectedMail extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 */
	public function __construct(public ApplicantStatus $applicantStatus)
	{
	}

	/**
	 * Get the message envelope.
	 */
	public function envelope(): Envelope
	{
		return new Envelope(from: new Address("sdppia@gmail.com", "Admin SDPPI"), subject: "Pengumumam Hasil Seleksi Magang SDPPI");
	}

	/**
	 * Get the message content definition.
	 */
	public function content(): Content
	{
		return new Content(view: "emails.reject-applicant");
	}

	/**
	 * Get the attachments for the message.
	 *
	 * @return array<int, \Illuminate\Mail\Mailables\Attachment>
	 */
	public function attachments(): array
	{
		return [];
	}
}
