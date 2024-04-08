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
    function formatDateFromNow(date: string): string {
        return moment(date).fromNow();
    }

    return {
        formatDate,
        formatDateFromNow,
        parsePostTags,
    };
}

export default useHelper;
