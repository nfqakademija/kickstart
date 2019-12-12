module.exports = on => {
    on('task', {
        log(message) {
            console.log(message);
            return null
        },
        /** @return {null} */
        LOG_DEBUG_CONSOLE(message) {
            console.log(`      : ${message}`);
            return null;
        },
        /** @return {null} */
        LOG_LOG_CONSOLE(message) {
            console.log(`       : ${message}`);
            return null;
        }
    });
};
