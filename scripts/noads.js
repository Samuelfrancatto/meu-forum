

const disableAds = document.getElementById('disable-ads')

let disabled = false

var disabledValue = localStorage.getItem('disabled')

if(disabledValue === 'true'){
    disableAds.checked = true
    disabled = true
}

disableAds.addEventListener('change', function(){
    if (disableAds.checked){
        disabled = true

    

        
    } else {
        disabled = false
    }

    localStorage.setItem('disabled', disabled)
})