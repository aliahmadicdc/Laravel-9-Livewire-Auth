<script>
    document.addEventListener('errorHandler', event => {
        let errors = event.detail.errors
        let livewire_success = event.detail.livewire_success
        let livewire_error = event.detail.livewire_error

        if (errors.length !== 0)
            for (let key in errors) {
                sendPushNotification(errors[key][0], 'warning')
            }

        if (livewire_success !== '' && livewire_success !== undefined)
            sendPushNotification(livewire_success, 'success')

        if (livewire_error !== '' && livewire_error !== undefined)
            sendPushNotification(livewire_error, 'warning')
    })
</script>
