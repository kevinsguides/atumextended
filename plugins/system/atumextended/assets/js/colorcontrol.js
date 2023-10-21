document.addEventListener('DOMContentLoaded', function() {
    
const toggle = document.getElementById('atumx-colortoggle');

toggle.addEventListener('click', function() {
    let oldColor = document.body.classList.contains('extended-dark-theme') ? 'dark' : 'light';

    if(oldColor == 'dark'){
        document.body.classList.remove('extended-dark-theme');
        document.body.classList.add('extended-light-theme');
        toggle.innerHTML = '<i class="fas fa-moon" aria-hidden="true"></i>';

        //cookie atumx_color_class to 'extended-light-theme'
        document.cookie = "atumx_color_class=extended-light-theme;path=/";
    }
    else{
        document.body.classList.remove('extended-light-theme');
        document.body.classList.add('extended-dark-theme');
        toggle.innerHTML = '<i class="fas fa-sun" aria-hidden="true"></i>';

        //cookie atumx_color_class to 'extended-dark-theme'
        document.cookie = "atumx_color_class=extended-dark-theme;path=/";

    }
}
);

});
