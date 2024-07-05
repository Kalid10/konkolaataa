
export function useUtilities(){
    function formatNumberWithCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function removeUnderscores(string) {
        return string.replace(/_/g, ' ');
    }
    function toSnakeCase(string) {
        return string.toLowerCase().replace(/\s+/g, "_");
    }

    function toCamelCase(string) {
        return string.toLowerCase().replace(/_/g, ' ').replace(/(?:^\w|[A-Z]|\b\w)/g, function(letter, index) {
            return index === 0 ? letter.toLowerCase() : letter.toUpperCase();
        }).replace(/\s+/g, '');
    }

    return {
        formatNumberWithCommas,
        removeUnderscores,
        toSnakeCase,
        toCamelCase
    }
}
