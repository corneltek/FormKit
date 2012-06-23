
var FormKit = {
      initializer: [ ]
    , register: function(cb) { 
        this.initializer.push(cb);
    }
    , load: function() {
        jQuery(document.body).ready(function() {
            for( var i in this.initializer ) {
                var cb = this.initializer[i];
                cb();
            }
        });
    }
};
