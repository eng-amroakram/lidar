<div style="width: 40rem;" wire:ignore>

    <div class="row">
        <div class="col-md-6">
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" maxlength="255" id="first_name"
                    class="form-control form-control-lg first-name-input" />
                <label class="form-label" for="first_name">Your First Name</label>
                <div class="form-helper text-danger first_name-validation reset-validation"></div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" maxlength="255" id="lastName"
                    class="form-control form-control-lg last-name-input" />
                <label class="form-label" for="lastName">Last Name</label>
                <div class="form-helper text-danger last_name-validation reset-validation"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="email" maxlength="255" class="form-control form-control-lg email-input" />
                <label class="form-label" for="email">Your Email</label>
                <div class="form-helper text-danger email-validation reset-validation"></div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="emailConfirmation"
                    class="form-control form-control-lg email-confirmation-input" />
                <label class="form-label" for="emailConfirmation">Email Confirmation</label>
                <div class="form-helper text-danger email-confirmation-validation reset-validation"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Password input -->
        <div class="col-md-12">
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="tel" maxlength="10" id="phone" class="form-control form-control-lg phone-input" />
                <label class="form-label" for="phone">Phone</label>
                <div class="form-helper text-danger phone-validation reset-validation"></div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- Password input -->
        <div class="col-md-6">
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" minlength="8" maxlength="50" id="passwordID"
                    class="form-control form-control-lg password-input" />
                <label class="form-label" for="passwordID">Password</label>
                <div class="form-helper text-danger password-validation reset-validation"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" minlength="8" maxlength="50" id="passwordConfirmation"
                    class="form-control form-control-lg password-confirmation-input" />
                <label class="form-label" for="passwordConfirmation">Password</label>
                <div class="form-helper text-danger password_confirmation-validation reset-validation"></div>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
        <!-- Checkbox -->
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="rememberMe" checked />
            <label class="form-check-label" for="rememberMe">Remember Me</label>
        </div>
        <div>
            <a href="#" class="text-dark">Do you have an account ?</a>
            <span> / </span>
            <a href="{{ route('frontend.index') }}" style="color:#7a9e85;">Login</a>
        </div>
    </div>

    <!-- Submit button -->


    <button type="submit" data-mdb-button-init="" data-mdb-ripple-init="" data-mdb-button-initialized="true"
        class="btn btn-lg text-white btn-block submit-register-button" style="background-color: #7a9e85;">
        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true" wire:loading></span>
        Register
    </button>

</div>



@push('admin-login-script')
    <script>
        $(document).ready(function() {

            // Values
            var $first_name_value = "";
            var $last_name_value = "";
            var $email_value = "";
            var $email_confirmation_value = "";
            var $phone_value = "";
            var $password_value = "";
            var $password_confirmation_value = "";

            // Validations
            var $first_name_validation = $(".first_name-validation");
            var $last_name_validation = $(".last_name-validation");
            var $email_validation = $(".email-validation");
            var $email_confirmation_validation = $(".email-confirmation-validation");
            var $phone_validation = $(".phone-validation");
            var $password_validation = $(".password-validation");
            var $password_confirmation_validation = $(".password_confirmation-validation");

            // Inputs
            var $first_name_input = $(".first-name-input");
            var $last_name_input = $(".last-name-input");
            var $email_input = $(".email-input");
            var $email_confirmation_input = $(".email-confirmation-input");
            var $phone_input = $(".phone-input");
            var $password_input = $(".password-input");
            var $password_confirmation_input = $(".password-confirmation-input");

            // Buttons
            var $submit_register_button = $(".submit-register-button");

            // Clear validation messages on input
            $first_name_input.on('input', function() {
                $first_name_validation.text("");
                $first_name_value = $(this).val();
            });

            $last_name_input.on('input', function() {
                $last_name_validation.text("");
                $last_name_value = $(this).val();
            });

            $email_input.on('input', function() {
                $email_validation.text("");
                $email_value = $(this).val();
            });

            $email_confirmation_input.on('input', function() {
                $email_confirmation_validation.text("");
                $email_confirmation_value = $(this).val();
            });

            $phone_input.on('input', function() {
                $phone_validation.text("");
                $phone_value = $(this).val();
            });

            $password_input.on('input', function() {
                $password_validation.text("");
                $password_value = $(this).val();
            });

            $password_confirmation_input.on('input', function() {
                $password_confirmation_validation.text("");
                $password_confirmation_value = $(this).val();
            });

            $submit_register_button.on('click', function() {
                event.preventDefault(); // Prevent the default form submission
                let isValid = validateRegistrationForm();

                if (isValid) {
                    @this.set('first_name', $first_name_value);
                    @this.set('last_name', $last_name_value);
                    @this.set('email', $email_value);
                    @this.set('email_confirmation', $email_confirmation_value);
                    @this.set('phone', $phone_value);
                    @this.set('password', $password_value);
                    @this.set('password_confirmation', $password_confirmation_value);
                    Livewire.dispatch('submitting-registration-data');
                }

            });

            function validateRegistrationForm() {
                let isValid = true;

                // Reset validation messages
                $first_name_validation.text("");
                $last_name_validation.text("");
                $email_validation.text("");
                $email_confirmation_validation.text("");
                $phone_validation.text("");
                $password_validation.text("");
                $password_confirmation_validation.text("");

                // Validate first name
                if (!$first_name_value) {
                    $first_name_validation.text("First name is required.");
                    isValid = false;
                }

                // Validate last name
                if (!$last_name_value) {
                    $last_name_validation.text("Last name is required.");
                    isValid = false;
                }

                // Validate email
                if (!$email_value) {
                    $email_validation.text("Email is required.");
                    isValid = false;
                } else if (!validateEmail($email_value)) {
                    $email_validation.text("Invalid email format.");
                    isValid = false;
                }

                // Validate email confirmation
                if (!$email_confirmation_value) {
                    $email_confirmation_validation.text("Email confirmation is required.");
                    isValid = false;
                } else if ($email_confirmation_value !== $email_value) {
                    $email_confirmation_validation.text("Email confirmation does not match.");
                    isValid = false;
                }

                // Validate phone
                if (!$phone_value) {
                    $phone_validation.text("Phone number is required.");
                    isValid = false;
                }

                // Validate password
                if (!$password_value) {
                    $password_validation.text("Password is required.");
                    isValid = false;
                } else if ($password_value.length < 8) {
                    $password_validation.text("Password must be at least 8 characters.");
                    isValid = false;
                } else {
                    // Validate password against regex
                    var passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/;
                    if (!passwordRegex.test($password_value)) {
                        $password_validation.text(
                            "Password must contain at least one uppercase and lowercase letter and digit."
                        );
                        isValid = false;
                    }
                }

                // Validate password confirmation
                if (!$password_confirmation_value) {
                    $password_confirmation_validation.text("Password confirmation is required.");
                    isValid = false;
                } else if ($password_confirmation_value !== $password_value) {
                    $password_confirmation_validation.text("Password confirmation does not match.");
                    isValid = false;
                }

                return isValid;
            }

            // Email format validation
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Handle server-side validation errors
            Livewire.on("admin-register-db-validation", function(errors) {
                $(".reset-validation").text("");
                for (let key in errors[0]) {
                    if (errors[0].hasOwnProperty(key)) {
                        $("." + key + "-validation").text(errors[0][key]);
                    }
                }
            });

        });
    </script>
@endpush
