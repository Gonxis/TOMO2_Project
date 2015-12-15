// JavaScript Document

jQuery(document).ready(function($) {
    var options = [
        {selector: '#contactUs', offset: 400, callback: 'Materialize.showStaggeredList(#formContactUs)' },
		 {selector: '#staggered-list', offset: 20, callback: 'Materialize.showStaggeredList("#staggered-list")' }
    ];
    Materialize.scrollFire(options);
});

/*function my_callback(){
    Materialize.toast('Hello!', undefined, '', my_callback);
<!--} */