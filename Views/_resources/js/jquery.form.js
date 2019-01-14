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

        $input.on('change input', function (e) {
            if (!$input[0].checkValidity()) {
                $error.show()
                $item.addClass('has--error').removeClass('is--ok')
            } else {
                $error.hide()
                $item.removeClass('has--error').addClass('is--ok')
            }
        })
    })
    
    $form.on('submit', function (e) {
        e.preventDefault()
        
        $form.addClass('sending')
        $form.find('.success-text').hide()
        
        $.post($form.attr('action'), $form.serialize(), function (response) {
            $form.removeClass('sending')
            
            if (response.success) {
                $form.trigger('reset')
                $form.find('.success-text').show()
            }
        })
    })
    
})(jQuery, window);