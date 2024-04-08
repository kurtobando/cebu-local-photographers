import moment from 'moment-timezone';

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
    function formatDate(date: string): string {
        return moment(date).format('MMMM Do YYYY');
    }

    return {
        formatDate,
        parsePostTags,
    };
}

export default useHelper;
