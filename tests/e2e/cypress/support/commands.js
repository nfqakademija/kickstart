Cypress.Commands.overwrite('log', (subject, message) => cy.task('log', message));


Cypress.Commands.add('ciDebug', (message) => cy.task('LOG_DEBUG_CONSOLE', message));
Cypress.Commands.add('ciLog', (message) => cy.task('LOG_LOG_CONSOLE', message));
