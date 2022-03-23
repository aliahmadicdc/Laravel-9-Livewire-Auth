function sendPushNotification(message, mode) {
    if (message != '') {
        let className = ''
        if (mode === 'success') className = 'alert alert-success'
        else if (mode === 'error') className = 'alert alert-danger'
        else className = 'alert alert-warning'

        const date = new Date()
        let time = date.getTime() + (Math.floor(Math.random() * 100) + 1)

        $('#push-notification').append(
            '<div id="notification-div-' + time + '" class="push-notification-p mb-1 col-12 ' + className + '">' +
            '<span class="push-notification-span ml-2">' + message + '</span>' +
            '<i id="notification-remove-' + time + '" class="push-notification-i ti-close back-ad-category-list push-notification-icon"></i></div>'
        )

        $('#notification-div-' + time).delay(1500).fadeOut(function () {
            $('#notification-div-' + time).remove()
        })

        $('#notification-remove-' + time).on('click', function () {
            removeElement('notification-div-' + time)
        })
    }
}

function removeElement(id) {
    $('#' + id).fadeOut(function () {
        $('#notification-div').remove()
    })
}
