  <!DOCTYPE html>

  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empathra - Application Status</title>
  </head>

  <body style="margin:0; padding:0; background-color:#f4f6f9; font-family: Arial, Helvetica, sans-serif;">

    ```
    <div
      style="max-width:600px; margin:40px auto; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.08);">

      <div style="background:#0d6efd; padding:20px; text-align:center;">
        <h1 style="color:#ffffff; margin:0; font-size:22px;">
          Empathra
        </h1>
      </div>


      <div style="padding:30px; color:#333; line-height:1.6;">

        <p>Hello <strong>{{ $name ?? 'John Doe' }}</strong>,</p>

        <p>
          Thank you for applying for the position of
          <strong>{{ $position ?? 'Manager' }}</strong>.
        </p>

        @if ($status === 'applied')
          <p>
            We have successfully received your application. Our team is currently reviewing it.
          </p>
        @endif

        @if ($status === 'assessment')
          <p>
            As part of our selection process, we would like you to complete a
            <strong>{{ $assessment_type ?? 'pre-employment assessment' }}</strong>.
          </p>

          <p>
            <strong>Platform / Location:</strong> {{ $location ?? 'Online Platform' }}
          </p>

          @if (!empty($notes))
            <p>
              <strong>Additional Instructions:</strong><br>
              {{ $notes }}
            </p>
          @endif

          <p>
            Please complete the assessment at your earliest convenience. Further instructions
            will be provided through the specified platform.
          </p>

          <br>
        @endif

        @if ($status === 'accepted')
          <p style="color:#198754; font-weight:bold; font-size:18px;">
            Congratulations! 🎉
          </p>

          <p>
            We are pleased to inform you that you have been
            <strong>accepted</strong> for the position of
            <strong>{{ $position ?? 'Manager' }}</strong>.
          </p>

          <p>
            Our team will contact you shortly regarding the next steps.
          </p>
        @endif

        @if ($status === 'rejected')
          <p style="color:#dc3545; font-weight:bold;">
            Thank you for your interest.
          </p>

          <p>
            After careful consideration, we regret to inform you that we will not be moving forward
            with your application for the <strong>{{ $position ?? 'Manager' }}</strong> position.
          </p>

          <p>
            We appreciate your time and encourage you to apply again in the future.
          </p>
        @endif


        <br>

        <p>Best regards,</p>
        <p style="font-weight:bold; margin-top:0;">
          Empathra Team
        </p>

      </div>

      <!-- Footer -->
      <div style="background:#f1f1f1; padding:20px; text-align:center; font-size:12px; color:#666;">

        <p style="margin:5px 0;">
          © {{ date('Y') }} Empathra. All rights reserved.
        </p>

        <p style="margin:5px 0;">
          This is an automated message. Please do not reply directly to this email.
        </p>

        <p style="margin:5px 0;">
          Contact us: hr@empathra.com
        </p>

      </div>

    </div>
    ```

  </body>

  </html>
