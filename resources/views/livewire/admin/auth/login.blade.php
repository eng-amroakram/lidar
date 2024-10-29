<div style="width: 30rem;" wire:ignore>

    @if ($otp_check == false)
        <div>
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="emailPhone" class="form-control form-control-lg email-phone-input" />
                <label class="form-label" for="emailPhone">Your Email or Phone Number</label>
                <div class="form-helper text-danger email_phone-validation"></div>
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="passwordID" class="form-control form-control-lg password-input" />
                <label class="form-label" for="passwordID">Password</label>
                <div class="form-helper text-danger password-validation"></div>

            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- Checkbox -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="rememberMe" checked />
                    <label class="form-check-label" for="rememberMe">Remember Me</label>
                </div>
                <div>
                    <a href="{{ route('auth.register') }}" style="color:#7a9e85;">Register</a>
                    <span> / </span>
                    <a href="{{ route('auth.forgot_password') }}" style="color:#7a9e85;">Forgot your password?</a>
                </div>
            </div>

            <!-- Submit button -->

            <button type="submit" data-mdb-button-init="" data-mdb-ripple-init="" data-mdb-button-initialized="true"
                class="btn btn-lg text-white btn-block submitting-login-button" style="background-color: #7a9e85;">
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"
                    wire:loading></span>
                Login
            </button>
        </div>
    @endif

    @if ($otp_check == true)
        <div>
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="otpCode" maxlength="6" minlength="6"
                    class="form-control form-control-lg otp-code-input" />
                <label class="form-label" for="otpCode">Enter Your OTP Code</label>
                <div class="form-helper text-danger otp_code-validation reset-validation"></div>
            </div>

            <button type="submit" data-mdb-button-init="" data-mdb-ripple-init="" data-mdb-button-initialized="true"
                class="btn btn-lg text-white btn-block submitting-otp-code-button" style="background-color: #7a9e85;">
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"
                    wire:loading></span>
                Verify Account
            </button>
        </div>
    @endif

</div>



@push('admin-login-script')
    <script>
        $(document).ready(function() {

            // Values
            let $email_phone_value = "";
            let $password_value = "";
            let $otp_code_value = "";


            // Validations
            const $email_phone_validation = $(".email_phone-validation");
            const $password_validation = $(".password-validation");
            const $otp_code_validation = $(".otp_code-validation");

            // Inputs
            const $phone_email_input = $(".email-phone-input");
            const $password_input = $(".password-input");
            const $otp_code_input = $(".otp-code-input");

            // Buttons
            const $submitting_login_button = $(".submitting-login-button");
            const $submitting_otp_code_button = $(".submitting-otp-code-button");


            // Clear validation messages on input
            $phone_email_input.on('input', function() {
                $email_phone_validation.text(""); // Clear validation message
                $email_phone_value = $(this).val(); // Update the email/phone value
            });

            $password_input.on('input', function() {
                $password_validation.text(""); // Clear validation message
                $password_value = $(this).val(); // Update the password value
            });


            // Login button click event
            $submitting_login_button.on('click', function() {
                const isValid = admin_login_validation(); // Validate input fields

                if (isValid) {
                    @this.set('email_phone', $email_phone_value); // Set email/phone value in Livewire
                    @this.set('password', $password_value); // Set password value in Livewire
                    Livewire.dispatch('submitting-login-data'); // Dispatch the event
                }
            });

            // OTP button click event
            $submitting_otp_code_button.on('click', function() {
                $otp_code_value = $otp_code_input.val(); // Get OTP code value

                if ($otp_code_value.length === 6) { // Check if OTP code is 6 digits
                    @this.set('otp_code', $otp_code_value); // Set OTP code in Livewire
                    Livewire.dispatch('submitting-otp-code-data'); // Dispatch OTP submission event
                } else {
                    $otp_code_validation.text("OTP code must be 6 digits."); // Show validation message
                }
            });


            // Admin login validation function
            function admin_login_validation() {
                $email_phone_validation.text(""); // Clear validation message
                $password_validation.text(""); // Clear validation message

                console.log($email_phone_value);

                // Check if both email/phone and password are provided
                if (!$email_phone_value && !$password_value) {
                    $email_phone_validation.text("Check the email or phone number");
                    $password_validation.text("Check the password");
                    return false;
                }

                if (!$email_phone_value) {
                    $email_phone_validation.text("Check the email or phone number");
                    return false;
                }
                if (!$password_value) {
                    $password_validation.text("Check the password");
                    return false;
                }

                return true; // Return true if all validations pass
            }

            // Validation response from the server
            Livewire.on('admin-db-login-validation', function(value) {
                const message = value[0];

                if (message.password) {
                    $password_validation.text(message.password); // Show password error message
                }

                if (message.email) {
                    $email_phone_validation.text(message.email); // Show email error message
                }
            });

            // Handle server-side validation errors
            Livewire.on("otp-code-validation", function(errors) {
                $(".reset-validation").text("");
                console.log(errors);
                for (let key in errors[0]) {
                    if (errors[0].hasOwnProperty(key)) {
                        $("." + key + "-validation").text(errors[0][key]);
                    }
                }
            });
        });
    </script>
@endpush
