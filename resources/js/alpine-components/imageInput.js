/**
 * Multiselect component.
 * @return {import('alpinejs').AlpineComponent}
 */
export default () => ({
    images: [],

    updateImagesFromFiles(files) {
        for (let i = 0; i < files.length; i++) {
            const images = [];

            for (let i = 0; i < files.length; i++) {
                const image = files[i];

                images.push({
                    src: URL.createObjectURL(image),
                    name: image.name,
                    size: image.size,
                });
            }

            this.images = images;
        }
    },

    handleInputChange(e) {
        const inputImages = e.target.files || [];
        this.updateImagesFromFiles(inputImages);
    },

    removeImage(index) {
        this.images.splice(index, 1);
        const dt = new DataTransfer();

        for (let i = 0; i < this.$refs.input.files.length; i++) {
            if (i !== index) {
                dt.items.add(this.$refs.input.files[i]);
            }
        }

        this.$refs.input.files = dt.files;
    },

    init() {
        if (!this.$refs.input) {
            throw new Error("Missing input element.");
        }

        const inputImages = this.$refs.input.files || [];
        this.updateImagesFromFiles(inputImages);
    },
});
