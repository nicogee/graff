jQuery(function($){

  var _header = $('#header');
  var _imgH = $('.wp-post-image').height();

  var _flag = 1;

  if(_flag == 1) {
    $(document).on('scroll', function (){

      _imgH = _imgH === null ? 100 : _imgH;

      var scrollTop = _header.offset().top;
      if(scrollTop >= _imgH) {
        _header.addClass('animated slideInDown').show();
        _flag = 0;
      }
    });
  }

});