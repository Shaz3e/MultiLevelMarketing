<div class="row">
    <div class="col-12">
        <div class="copySuccess" style="display:none;">
            <div class="alert alert-primary bg-theme">
                Referral link is copied to clipboard
            </div>
        </div>
        <div class="input-group">
            <input class="form-control" value="{{ env('APP_URL') . '/register?ref=' . auth()->user()->id }}"
                id="copyRefferalCode" disabled>
            <span class="input-group-append">
                <button type="button" onclick="copyToClipboard()"
                    class="btn btn-dark btn-lg waves-effect waves-light">Copy</button>
            </span>
        </div>
        <div class="mt-3">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ env('APP_URL') . '/register?ref=' . auth()->user()->id }}"
                class="btn btn-primary btn-sm waves-effect waves-light" target="_blank">
                <i class="ri-facebook-box-fill align-middle me-2"></i>
                <span>Facebook</span>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ env('APP_URL') . '/register?ref=' . auth()->user()->id }}"
                class="btn btn-primary btn-sm waves-effect waves-light" target="_blank">
                <i class="ri-instagram-fill align-middle me-2"></i>
                <span>Instagram</span>
            </a>
            <a href="https://api.whatsapp.com/send?text={{ env('APP_URL') . '/register?ref=' . auth()->user()->id }}"
                class="btn btn-primary btn-sm waves-effect waves-light" target="_blank">
                <i class="ri-whatsapp-fill align-middle me-2"></i>
                <span>Whatsapp</span>
            </a>
            <a href="https://twitter.com/intent/tweet?text={{ env('APP_URL') . '/register?ref=' . auth()->user()->id }}"
                class="btn btn-primary btn-sm waves-effect waves-light" target="_blank">
                <i class="ri-twitter-x-fill align-middle me-2"></i>
                <span>Twitter</span>
            </a>
            <a href="mailto:recipient@example.com?subject=&body={{ env('APP_URL') . '/register?ref=' . auth()->user()->id }}"
                class="btn btn-primary btn-sm waves-effect waves-light" target="_blank">
                <i class="ri-mail-star-fill align-middle me-2"></i>
                <span>Mail</span>
            </a>
        </div>
    </div>
    {{-- /.col --}}
</div>
{{-- /.row --}}

@push('styles')
@endpush

@push('scripts')
    <script>
        // Copy to Clipboard
        function copyToClipboard() {
            /* Get the text field */
            var copyText = document.getElementById("copyRefferalCode");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

            /* Alert the copied text */
            $(".copySuccess").show();
            //alert("Copied the text: " + copyText.value);
        }
    </script>
@endpush
