

var disabledValue = localStorage.getItem('disabled')

const adFrame = document.getElementById('ad-frame')

if (disabledValue === 'true'){
    adFrame.style.display = 'none'
} else {
    adFrame.style.display = 'block'
}