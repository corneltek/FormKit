/*
$(document.body).ready(function() {
    FormKit.install();
    FormKit.initialize(document.body);
});

Inside Ajax Region:

    $(document.body).ready(function() {
        FormKit.initialize( div element );
    });

*/
var FormKit = {
    register: function(initHandler,installHandler) { 
        $(FormKit).bind('formkit.initialize',initHandler);
        if( installHandler ) {
            $(this).bind('formkit.install',installHandler);
        }
    },
    initialize: function(scopeEl) {
        if(!scopeEl)
            scopeEl = document.body;
        $(FormKit).trigger('formkit.initialize',[scopeEl]);
    },
    install: function() {
        $(FormKit).trigger('formkit.install');
    }
};

