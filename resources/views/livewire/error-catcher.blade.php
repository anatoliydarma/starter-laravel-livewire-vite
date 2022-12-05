<div>
    <script>
        var hasLoggedOnce = '';
        window.onerror = function(msg, source, lineNo, columnNo, error) {
            if (hasLoggedOnce !== msg) {
                Livewire.emit("getError", msg, source, lineNo, columnNo, error, window.location.href);
            }
            hasLoggedOnce = msg;
        }
    </script>
</div>
