



window.addEventListener('beforeunload', function(event) {
    event.preventDefault()
})


document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', function(event) {
        const url = new URL(link.href)

        if (url.origin !== window.location.origin) {
            const confirmRedirect = confirm('Você está deixando este site. deseja continuar?')
            if(!confirmRedirect)
                {
                    event.preventDefault()
                }

        }
        })
})