function useHelper() {
    function parsePostTags(tags: string): string {
        try {
            return JSON.parse(tags)
                .map((tag: string) => `#${tag}`)
                .join(' ');
        } catch (error) {
            return tags.toString();
        }
    }

    return {
        parsePostTags,
    };
}

export default useHelper;
