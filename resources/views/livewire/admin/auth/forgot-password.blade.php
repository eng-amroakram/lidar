<div style="width: 30rem;" wire:ignore>

    @if ($check_otp == false && $check_password == false)
        <div>
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="emailPhone" class="form-control form-control-lg email-phone-input" />
                <label class="form-label" for="emailPhone">Your Email or Phone Number</label>
                <div class="form-helper text-danger email_phone-validation reset-validation"></div>
            </div>

            <!-- Submit button -->
            <button type="submit" data-mdb-button-init="" data-mdb-ripple-init="" data-mdb-button-initialized="true"
                class="btn btn-lg text-white btn-block submitting-recovery-password-button"
                style="background-color: #7a9e85;">
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"
                    wire:loading></span>
                Send OTP Code
            </button>

        </div>
    @endif

    @if ($check_password == true && $check_otp == false)
        <div>
            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="passwordID" class="form-control form-control-lg password-input" />
                <label class="form-label" for="passwordID">New Password</label>
                <div class="form-helper text-danger password-validation reset-validation"></div>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="passwordConfirmation"
                    class="form-control form-control-lg password-confirmation-input" />
                <label class="form-label" for="passwordConfirmation">Password Confirmation</label>
                <div class="form-helper text-danger password_confirmation-validation reset-validation"></div>
            </div>


            <!-- Submit button -->
            <button type="submit" data-mdb-button-init="" data-mdb-ripple-init="" data-mdb-button-initialized="true"
                class="btn btn-lg text-white btn-block submitting-resetting-password-button"
                style="background-color: #7a9e85;">
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"
                    wire:loading></span>
                Reset Your Password
            </button>
        </div>
    @endif

    @if ($check_otp == true && $check_password == false)
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
            let $otp_code_value = "";

            let $password_value = "";
            let $password_confirmation = "";


            // Validations
            const $email_phone_validation = $(".email_phone-validation");
            const $password_validation = $(".password-validation");
            const $password_confirmation_validation = $(".password_confirmation-validation");
            const $otp_code_validation = $(".otp_code-validation");

            // Inputs
            const $phone_email_input = $(".email-phone-input");
            const $password_input = $(".password-input");
            const $password_confirmation_input = $(".password-confirmation-input");
            const $otp_code_input = $(".otp-code-input");

            // Buttons
            const $submitting_recovery_password_button = $(".submitting-recovery-password-button");
            const $submitting_otp_code_button = $(".submitting-otp-code-button");
            const $submitting_resetting_password_button = $(".submitting-resetting-password-button");


            // Clear validation messages on input
            $phone_email_input.on('input', function() {
                $email_phone_validation.text(""); // Clear validation message
                $email_phone_value = $(this).val(); // Update the email/phone value
            });

            $password_input.on('input', function() {
                $password_validation.text(""); // Clear validation message
                $password_value = $(this).val(); // Update the password value
            });

            $password_confirmation_input.on('input', function() {
                $password_confirmation_validation.text(""); // Clear validation message
                $password_confirmation_value = $(this).val(); // Update the password value
            });

            $otp_code_input.on('input', function() {
                $otp_code_validation.text(""); // Clear validation message
                $otp_code_value = $(this).val(); // Update the email/phone value
            });

            // Login button click event
            $submitting_recovery_password_button.on('click', function() {
                const isValid = email_phone_validation(); // Validate input fields

                if (isValid) {
                    @this.set('email_phone', $email_phone_value); // Set email/phone value in Livewire
                    Livewire.dispatch('submitting-recovery-password-data'); // Dispatch the event
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

            //Restting Your Password
            $submitting_resetting_password_button.on('click', function() {
                const isValid = resetting_password_validation();

                if (isValid) {
                    @this.set('password', $password_value); // Set email/phone value in Livewire
                    @this.set('password_confirmation',
                        $password_confirmation_value); // Set email/phone value in Livewire
                    Livewire.dispatch('submitting-resetting-password-data'); // Dispatch the event
                }
            });

            // Admin login validation function
            function email_phone_validation() {
                $email_phone_validation.text(""); // Clear validation message

                if (!$email_phone_value) {
                    $email_phone_validation.text("Check the email or phone number");
                    return false;
                }

                return true; // Return true if all validations pass
            }

            // Admin login validation function
            function resetting_password_validation() {
                $password_validation.text(""); // Clear validation message
                $password_confirmation_validation.text(""); // Clear validation message

                // Check if both email/phone and password are provided
                if (!$password_confirmation_value && !$password_value) {
                    $password_validation.text("Check Your Password");
                    $password_confirmation_validation.text("Confirm Your Password");
                    return false;
                }

                if (!$password_value) {
                    $password_validation.text("Check Your password");
                    return false;
                }

                if (!$password_confirmation_value) {
                    $password_confirmation_validation.text("Confirm Your Password");
                    return false;
                }

                return true; // Return true if all validations pass
            }

            // Handle server-side validation errors
            Livewire.on("recovery-password-db-validation", function(errors) {
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
