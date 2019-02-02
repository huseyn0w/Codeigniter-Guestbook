$(function(){
    tinymce.init({
        selector: '#editor-container',
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
    });

    if($("#recaptchaResponse").length){
        grecaptcha.ready(function () {
            grecaptcha.execute('6Lf4pY4UAAAAAFV0SfQrjCCC5Ttg4PCXsFrwncad', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    }
});