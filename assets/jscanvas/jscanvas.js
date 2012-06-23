(function($) {
    jQuery.fn.canvasWidget = function(options) {
        var $container = $(this);

        if( $container.data('canvas') ) {
            return;
        }
        $container.data('canvas',1);

        var $input = $container.find('input:eq(0)');
        var $color = $container.find('input.color:eq(0)');

        var $tools = $(
            '<span>' +
            '<button>×</button> ' +
            '<button>．</button>' +
            '<button>＼</button>' +
            '<button>囗</button>' +
            '<button>〇</button>' +
            '</span>'
        );
        $container.prepend($tools);

        var tool = 'dot';
        $tools.find('button:eq(0)').click(function(){ tool = 'eraser'; return false });
        $tools.find('button:eq(1)').click(function(){ tool = 'dot'; return false });
        $tools.find('button:eq(2)').click(function(){ tool = 'line'; return false });
        $tools.find('button:eq(3)').click(function(){ tool = 'rect'; return false });
        $tools.find('button:eq(4)').click(function(){ tool = 'ellipse'; return false });

        var $canvas_bg = $container.find('canvas:eq(0)');
        $canvas_bg
            .css('width', $canvas_bg.attr('width')+'px')
            .css('height', $canvas_bg.attr('height')+'px');

        var bg_offset = $canvas_bg.offset();
        var $canvas_fg = $('<canvas/>');
        $('body').append($canvas_fg);

        var bg_ctx = $canvas_bg.get(0).getContext('2d');
        var fg_ctx = $canvas_fg.get(0).getContext('2d');

        var init_cursor = null;
        var cursor = null;

        var clear_fg = function(){
            fg_ctx.canvas.width = fg_ctx.canvas.width;
        };

        var tools = {
            eraser: function(x, y, draw){
                clear_fg();
                fg_ctx.strokeStyle = '#000000';
                fg_ctx.strokeRect(x-5, y-5, 10, 10);
                if( draw )
                    bg_ctx.clearRect(x-5, y-5, 10, 10);
            },
            dot: function(x, y, draw){
                if( draw ){
                    bg_ctx.save();
                    bg_ctx.strokeStyle = '#'+$color.val();
                    bg_ctx.beginPath();
                    bg_ctx.moveTo(cursor[0], cursor[1]);
                    bg_ctx.lineTo(x, y);
                    bg_ctx.stroke();
                    bg_ctx.restore();
                }
            },
            line: function(x, y, draw){
                if( draw ){
                    clear_fg();
                    fg_ctx.strokeStyle = '#'+$color.val();
                    fg_ctx.beginPath();
                    fg_ctx.moveTo(init_cursor[0], init_cursor[1]);
                    fg_ctx.lineTo(x, y);
                    fg_ctx.stroke();
                }
            },
            rect: function(x, y, draw){
                if( draw ){
                    clear_fg();
                    fg_ctx.strokeStyle = '#'+$color.val();

                    var x0 = x < init_cursor[0] ? x : init_cursor[0];
                    var y0 = y < init_cursor[1] ? y : init_cursor[1];
                    fg_ctx.strokeRect(x0, y0, init_cursor[0]+x-x0-x0, init_cursor[1]+y-y0-y0);
                }
            },
            ellipse: function(x, y, draw){
                if( draw ){
                    clear_fg();
                    fg_ctx.save();
                    var x0 = x < init_cursor[0] ? x : init_cursor[0];
                    var y0 = y < init_cursor[1] ? y : init_cursor[1];
                    var w = (init_cursor[0]+x)/2-x0;
                    var h = (init_cursor[1]+y)/2-y0;

                    if( w<=0 || h<=0 )
                        return;


                    fg_ctx.strokeStyle = '#'+$color.val();
                    fg_ctx.lineWidth = 1/Math.sqrt(w*w+h*h);

                    fg_ctx.translate(x0+w, y0+h);
                    fg_ctx.scale(w, h);

                    fg_ctx.beginPath();
                    fg_ctx.arc(0, 0, 1, 0, 2*Math.PI);
                    fg_ctx.stroke();
                    fg_ctx.restore();
                }
            }
        };

        $canvas_fg
            .attr('width', $canvas_bg.attr('width'))
            .attr('height', $canvas_bg.attr('height'))
            .css('position', 'absolute')
            .css('left', bg_offset.left + 'px')
            .css('top', bg_offset.top + 'px')
            .mousedown(function(ev){
                init_cursor = cursor = [ev.pageX-bg_offset.left, ev.pageY-bg_offset.top];
            })
            .mouseup(function(ev){
                init_cursor = cursor = null;
                if( tool!='eraser' )
                    bg_ctx.drawImage(fg_ctx.canvas, 0, 0);
                clear_fg();
                $input.val(bg_ctx.canvas.toDataURL());
            })
            .mousemove(function(ev){
                var x = ev.pageX-bg_offset.left;
                var y = ev.pageY-bg_offset.top;
                if( init_cursor ){
                    tools[tool](x, y, true);
                    cursor = [x, y];
                }
                else{
                    tools[tool](x, y, false);
                }
            })
            .mouseout(function(ev){
                init_cursor = cursor = null;
                clear_fg();
            })
        ;

        if( $input.val() ){
            var img = document.createElement('img');
            $('body').append($(img));
            img.onload = function(){
                bg_ctx.drawImage(img, 0, 0);
                img.parentNode.removeChild(img);
            };
            img.setAttribute('src', $input.val());
        }
    };

    jQuery(function(){
        $('.formkit-canvas').each(function(){
            $(this).canvasWidget();
        });
    });
})(jQuery);

