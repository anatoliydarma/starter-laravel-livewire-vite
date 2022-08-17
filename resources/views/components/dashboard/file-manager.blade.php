<div>
  @once
    @if (request()->is('/file-manager/fm-button*'))
      @push('header-css')
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
      @endpush
      @push('footer')
        <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
      @endpush
    @endif
  @endonce
  <button class="hover:text-orange-500">
    <x-tabler-cloud-upload class=" w-7 h-7" id="file-manager" />
  </button>

  <div>
    <script>
      document.addEventListener("DOMContentLoaded", function() {

        document.getElementById('file-manager').addEventListener('click', (event) => {
          event.preventDefault();

          window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
        });

      });

      function fmSetLink($url) {
        setTimeout(async () => navigator.clipboard.writeText($url), 100)
        Toast.success('Ссылка на файл скопирована');
      }
    </script>
  </div>

</div>
