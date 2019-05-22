$(function(){
var overlay = $('<div id="overlay"></div>');
overlay.show();
overlay.appendTo(document.body);
$('.popup1').show();
$('.close').click(function(){
$('.popup1').hide();
overlay.appendTo(document.body).remove();
return false;
});

$('.x').click(function(){
$('.popup1').hide();
overlay.appendTo(document.body).remove();
return false;
});
});
