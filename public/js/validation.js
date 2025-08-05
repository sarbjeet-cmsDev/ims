$(document).ready(function () {
    function validateCustomerForm(formSelector) {
        $(formSelector).validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 15
                },
                company_name: {
                    required: true
                },
                contact_person: {
                    required: true
                },
                customer_type: {
                    required: true
                },
                tax_id: {
                    required: true
                },
                status: {
                    required: true
                },
                credit_limit: {
                    required: true,
                    number: true,
                    min: 0
                },
                total_purchases: {
                    required: true,
                    number: true,
                    min: 0
                },
                last_purchase_at: {
                    required: true,
                    date: true
                },
                registered_at: {
                    required: true,
                    date: true
                },
                notes: {
                    maxlength: 1000,
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Name is required.",
                    minlength: "Name must be at least 3 characters."
                },
                email: {
                    required: "Email is required.",
                    email: "Enter a valid email address."
                },
                phone: {
                    required: "Phone number is required.",
                    digits: "Only digits are allowed.",
                    minlength: "Phone number must be at least 10 digits.",
                    maxlength: "Phone number must not exceed 15 digits."
                },
                company_name: {
                    required: "Company name is required."
                },
                contact_person: {
                    required: "Contact person is required."
                },
                customer_type: {
                    required: "Please select customer type."
                },
                tax_id: {
                    required: "Tax ID is required."
                },
                status: {
                    required: "Please select status."
                },
                credit_limit: {
                    required: "Credit limit is required.",
                    number: "Enter a valid number.",
                    min: "Credit limit cannot be negative."
                },
                total_purchases: {
                    required: "Total purchases is required.",
                    number: "Enter a valid number.",
                    min: "Total purchases cannot be negative."
                },
                last_purchase_at: {
                    required: "Last purchase date is required.",
                    date: "Enter a valid date."
                },
                registered_at: {
                    required: "Registered date is required.",
                    date: "Enter a valid date."
                },
                notes: {
                    maxlength: "Notes cannot exceed 1000 characters."
                }
            },
            errorElement: "span",
            errorClass: "text-red-500 text-sm",
            highlight: function (element) {
                $(element).addClass("border-red-500");
            },
            unhighlight: function (element) {
                $(element).removeClass("border-red-500");
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    if ($('#customer-form').length) {
        validateCustomerForm('#customer-form');
    }
    if ($('#edit-customer-form').length) {
        validateCustomerForm('#edit-customer-form');
    }
});


$(document).ready(function () {
    function validateCustomerForm(formSelector, rules, messages) {
        $(formSelector).validate({
            rules: rules,
            messages: messages,
            errorElement: "span",
            errorClass: "text-red-500 text-sm",
            highlight: function (element) {
                $(element).addClass("border-red-500");
            },
            unhighlight: function (element) {
                $(element).removeClass("border-red-500");
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    const addressValidationRules = {
        customer_id: {
            required: true
        },
        address_type: {
            required: true
        },
        street_address: {
            required: true,
            minlength: 5
        },
        apartment: {
            maxlength: 50,
            required: true
        },
        city: {
            required: true
        },
        state: {
            required: true
        },
        postal_code: {
            required: true,
            maxlength: 10
        },
        country: {
            required: true
        },
        latitude: {
            required: true,
            number: true
        },
        longitude: {
            required: true,
            number: true
        },
        phone: {
            required: true,
            digits: true,
            minlength: 10,
            maxlength: 15
        },
        is_default: {
            required: true
        },
        notes: {
            maxlength: 1000,
            required: true
        }
    };

    const addressValidationMessages = {
        customer_id: {
            required: "Please select a customer."
        },
        address_type: {
            required: "Please select an address type."
        },
        street_address: {
            required: "Street address is required.",
            minlength: "Street address must be at least 5 characters."
        },
        apartment: {
            maxlength: "Apartment cannot exceed 50 characters."
        },
        city: {
            required: "City is required."
        },
        state: {
            required: "State is required."
        },
        postal_code: {
            required: "Postal code is required.",
            maxlength: "Postal code cannot exceed 10 characters."
        },
        country: {
            required: "Country is required."
        },
        latitude: {
            number: "Please enter a valid latitude.",
              required: "latitude is required."
        },
        longitude: {
            number: "Please enter a valid longitude.",
            required: "longitude is required."
        },
        phone: {
            required: "Phone number is required.",
            digits: "Only digits are allowed.",
            minlength: "Phone number must be at least 10 digits.",
            maxlength: "Phone number must not exceed 15 digits."
        },
        is_default: {
            required: "Please specify if this is the default address."
        },
        notes: {
            maxlength: "Notes cannot exceed 1000 characters."
        }
    };

    if ($('#customer-addresses-form').length) {
        validateCustomerForm('#customer-addresses-form', addressValidationRules, addressValidationMessages);
    }

    if ($('#edit-customer-addresses-form').length) {
        validateCustomerForm('#edit-customer-addresses-form', addressValidationRules, addressValidationMessages);
    }
});


