/**
 * Multiselect component.
 * @return {import('alpinejs').AlpineComponent}
 */
export default () => ({
    open: false,
    options: [],

    get selectedOptions() {
        return this.options.filter((option) => option.selected);
    },

    handleOptionClick(index) {
        const option = this.options[index];

        if (option.selected) {
            option.selected = false;
            this.$refs.select.options[index + 1].selected = false;
        } else {
            option.selected = true;
            this.$refs.select.options[index + 1].selected = true;
        }
    },

    removeSelectedOption(option) {
        const optionsIndex = this.options.findIndex(
            (item) => item.value === option.value
        );

        if (optionsIndex === -1) {
            return;
        }

        this.options[optionsIndex].selected = false;
        this.$refs.select.options[optionsIndex + 1].selected = false;
    },

    init() {
        if (!this.$refs.select) {
            throw new Error("Missing select element.");
        }

        const options = [];
        const selectOptions = this.$refs.select.options || [];

        for (let i = 1; i < selectOptions.length; i++) {
            const option = selectOptions[i];

            options.push({
                value: option.value,
                text: option.text,
                selected: option.selected,
            });
        }

        this.options = options;
    },
});
