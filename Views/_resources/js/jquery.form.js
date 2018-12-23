;(function ($, window, undefined) {
    "use strict";
    
    var $form = $('form.form')
    
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