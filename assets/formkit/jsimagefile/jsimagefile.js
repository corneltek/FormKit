FormKit.register(function(e,scopeEl) {
    $(scopeEl).find('.formkit-widget-imagefile').each(function(){
        var $this = $(this);
        if( $this.hasClass('done') )
            return;
        $this.addClass('done');
        if( $this.data('url') ){
            var src = $this.data('url'),
                image = new Image;
            image.onload = function(){
                var width = parseInt($this.data('max-width'), 10),
                    height = parseInt($this.data('max-height'), 10);
                if( width && image.width > width )
                    image.height *= width / image.width;
                if( height && image.height > height )
                    image.width *= height / image.height;
                image.border = 0;
                $this.after($('<a>')
                    .attr('href', src)
                    .attr('target', '_blank')
                    .append($(image))
                    .insertAfter($this))
                    .after('<br/>');
            };
            image.src = src;
        }
    });
});
