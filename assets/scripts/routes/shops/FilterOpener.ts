const FilterOpener = () => {
    const openFilterButton = document.querySelector('.js-filter-opener');

    if (!openFilterButton) {
        return;
    }

    openFilterButton.addEventListener('click', function () {
        const filterWrapper = document.querySelector('.js-filter-container');

        if (!filterWrapper) {
            return;
        }

        if (filterWrapper.classList.contains('active')) {
            filterWrapper.classList.remove('active');
            document.body.classList.remove('overflow-hidden');
        } else {
            filterWrapper.classList.add('active');
            document.body.classList.add('overflow-hidden');
        }
    });
}

export { FilterOpener };
