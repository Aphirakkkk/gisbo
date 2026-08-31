/*function openNav() {
  document.getElementById("canvas").style.marginLeft = "-75%";
}*/
$('.btn-2').css('display', 'none');
$('.btn-1').click(function() {
    $('#canvas').css('margin-left','-75%');
    $(this).css('display', 'none');
    $('.btn-2').css('display', 'block');
});
$('.btn-2').click(function() {
    $('#canvas').css('margin-left','0');
    $(this).css('display', 'none');
    $('.btn-1').css('display', 'block');
});