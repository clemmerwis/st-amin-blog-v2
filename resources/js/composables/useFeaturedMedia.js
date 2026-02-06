import { ref } from 'vue';

export function useFeaturedMedia() {
    const featuredImg = ref([]);
    const urlFeaturedImg = ref(null);
    const featuredGif = ref([]);
    const urlFeaturedGif = ref(null);

    function updateFeaturedImage(event) {
        urlFeaturedImg.value = null;
        featuredImg.value = Array.from(event.target.files);
    }

    function clearFileInput() {
        urlFeaturedImg.value = null;
        featuredImg.value = [];
    }

    function updateFeaturedGif(event) {
        urlFeaturedGif.value = null;
        featuredGif.value = Array.from(event.target.files);
    }

    function clearGifInput() {
        urlFeaturedGif.value = null;
        featuredGif.value = [];
    }

    /**
     * Apply media fields to payload object
     * @param {Object} payload - The payload object to modify
     * @returns {Object} - The modified payload
     */
    function applyMediaToPayload(payload) {
        // Handle featured image
        if (!urlFeaturedImg.value && featuredImg.value.length === 0) {
            payload.image_featured = "clear";
        }
        if (!urlFeaturedImg.value && featuredImg.value.length !== 0) {
            payload.image_featured = featuredImg.value;
        }

        // Handle featured GIF
        if (!urlFeaturedGif.value && featuredGif.value.length === 0) {
            payload.gif_featured = "clear";
        }
        if (!urlFeaturedGif.value && featuredGif.value.length !== 0) {
            payload.gif_featured = featuredGif.value;
        }

        return payload;
    }

    /**
     * Append media fields to FormData
     * @param {FormData} formData - The FormData object
     * @param {Object} payload - The payload with media fields
     */
    function appendMediaToFormData(formData, payload) {
        // Append image_featured
        if (payload.image_featured) {
            if (payload.image_featured !== "clear") {
                formData.append("image_featured", payload.image_featured[0]);
            } else {
                formData.append("image_featured", payload.image_featured);
            }
        }

        // Append gif_featured
        if (payload.gif_featured) {
            if (payload.gif_featured !== "clear") {
                formData.append("gif_featured", payload.gif_featured[0]);
            } else {
                formData.append("gif_featured", payload.gif_featured);
            }
        }
    }

    return {
        featuredImg,
        urlFeaturedImg,
        featuredGif,
        urlFeaturedGif,
        updateFeaturedImage,
        clearFileInput,
        updateFeaturedGif,
        clearGifInput,
        applyMediaToPayload,
        appendMediaToFormData,
    };
}
