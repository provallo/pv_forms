;(function ($, window, undefined) {
    "use strict";

    var $form = $('form.form')

    $form.find('.form-item').each(function() {
        var $item = $(this)
        var required = $item.data('required')
        var $input = $item.find('.input')
        var $error = $item.find('.invalid-value')

        if (!required) {
            return
        }

        $input.on('change input blur validate', function (e, data) {
            if (data && data.allowInvalid) {
                $error.hide()
                $item.removeClass('has--error').removeClass('is--ok')
                return
            }

            if (!$input[0].checkValidity()) {
                $error.show()
                $item.addClass('has--error').removeClass('is--ok')
            } else {
                $error.hide()
                $item.removeClass('has--error').addClass('is--ok')
            }
        })
    })

    function sendForm () {
        $.post($form.attr('action'), $form.serialize(), function (response) {
            $form.removeClass('sending')

            if (response.success) {
                $form.trigger('reset')
                $form.find('.success-text').show()

                $form.find('.input').trigger('validate', {allowInvalid: true})
            }
        })
    }

    $form.on('submit', function (e) {
        var formID = $form.attr('data-id')
        var siteKey = $form.attr('data-site-key')

        e.preventDefault()

        $form.addClass('sending')
        $form.find('.success-text').hide()

        if (siteKey && siteKey.length > 0) {
            grecaptcha.ready(function () {
                grecaptcha.execute(siteKey, {action: 'form_' + formID}).then(function (token) {
                    $('input[name="g-recaptcha-response"]').val(token)
                    sendForm()
                })
            })
        } else {
            sendForm()
        }
    })

})(jQuery, window);