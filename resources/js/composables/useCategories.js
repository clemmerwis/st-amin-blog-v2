import { ref, computed, watch } from 'vue';
import axios from 'axios';

export function useCategories(initialCats = []) {
    const selectedMainCategory = ref('');
    const selectedSubCategories = ref(['']);
    const mainCategories = ref(['All', ...initialCats]);
    const subCategories = ref([]);
    const categoriesLoading = ref(false);

    const subCategoriesApiUrl = computed(() => {
        return `/api/categories/${selectedMainCategory.value}/children`;
    });

    const subCategoriesChunks = computed(() => {
        if (!Array.isArray(subCategories.value)) {
            return [];
        }

        const chunkSize = 4;
        return subCategories.value.reduce((resultArray, item, index) => {
            const chunkIndex = Math.floor(index / chunkSize);

            if (!resultArray[chunkIndex]) {
                resultArray[chunkIndex] = [];
            }

            resultArray[chunkIndex].push(item);

            return resultArray;
        }, []);
    });

    async function fetchSubCategories(url) {
        categoriesLoading.value = true;

        try {
            const response = await axios.get(url);
            subCategories.value = response.data;
        } catch (error) {
            console.error('Failed to fetch subcategories:', error);
        } finally {
            categoriesLoading.value = false;
        }
    }

    async function loadAllSubCategories() {
        try {
            const response = await axios.get('/api/categories/sub');
            subCategories.value = response.data;
            return response.data;
        } catch (error) {
            console.error('Failed to fetch subcategories:', error);
            return [];
        }
    }

    function handleMainCategoryChange() {
        fetchSubCategories(subCategoriesApiUrl.value);
    }

    /**
     * Initialize categories for editing an existing post
     * @param {Array} postCategories - The post's current categories
     */
    function initFromPost(postCategories) {
        const mainCat = postCategories.find(cat => cat.parent_id === null);
        if (mainCat) {
            selectedMainCategory.value = mainCat.name;
        }

        selectedSubCategories.value = postCategories
            .filter(cat => cat.parent_id !== null)
            .map(cat => cat.name);
    }

    /**
     * Get combined categories array for payload
     * Filters subcategories to only include those belonging to the current main category
     * @returns {Array} - Combined main and sub categories
     */
    function getCombinedCategories() {
        // Filter subcategories to only include those belonging to the current main category
        const validSubCatNames = subCategories.value.map(cat => cat.name);
        const filteredSubs = selectedSubCategories.value.filter(
            name => validSubCatNames.includes(name)
        );

        return [
            selectedMainCategory.value,
            ...filteredSubs,
        ];
    }

    // Watch for URL changes and fetch subcategories
    watch(subCategoriesApiUrl, (newUrl) => {
        if (selectedMainCategory.value) {
            fetchSubCategories(newUrl);
        }
    });

    return {
        selectedMainCategory,
        selectedSubCategories,
        mainCategories,
        subCategories,
        subCategoriesChunks,
        categoriesLoading,
        subCategoriesApiUrl,
        handleMainCategoryChange,
        fetchSubCategories,
        loadAllSubCategories,
        initFromPost,
        getCombinedCategories,
    };
}
