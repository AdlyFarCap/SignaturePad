<div>
    <div x-data="signaturePad()" class="relative shadow-xl bg-white rounded-lg p-6 flex flex-col gap-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-700 flex items-center justify-between"><span>Signature pad</span>
            </h1>
            <div>
                <canvas x-ref="signature_canvas" class="border rounded shadow">

                </canvas>
            </div>
        </div>
        <button x-on:click="upload">
            Submit
        </button>
    </div>

</div>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('signaturePad', (value) => ({
                signaturePadInstance: null,
                value: value,
                init() {
                    this.signaturePadInstance = new SignaturePad(this.$refs.signature_canvas);
                    this.signaturePadInstance.addEventListener("endStroke", () => {
                        this.value = this.signaturePadInstance.toDataURL('image/png');
                    });
                },
                upload() {
                    @this.set('signature', this.signaturePadInstance.toDataURL('image/png '));
                    @this.call('submit');
                }
            }))
        })
    </script>
@endpush
