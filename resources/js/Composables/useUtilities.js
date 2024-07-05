
export function useUtilities(){
     function formatNumberWithCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function removeUnderscores(string) {
        return string.replace(/_/g, ' ');
    }
    return {
        formatNumberWithCommas,
        removeUnderscores
    }
}
