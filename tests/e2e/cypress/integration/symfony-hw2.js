const basePath = Cypress.env('BASE_URL') ? Cypress.env('BASE_URL') : 'http://127.0.0.1:8000';

const d = async (message) => {
    console.info('D', message);
    await cy.ciDebug(message);
};
const dd = async (message) => {
    console.log('DD', message);
    await cy.ciLog(message);
};

const second = 1000;

describe('Secodn homework', function() {
    it('Whole page: Homepage', () => {
        cy.visit(basePath);
        cy.screenshot();
    });
    it('Whole page: People', () => {
        cy.visit(`${basePath}/people`);
        cy.screenshot();
    });

    it('Test old functionality: happy case', () => {
        cy.visit(`${basePath}/people`);
        cy.get("#name").type("lukas");
        cy.wait(second);
        cy.get("#validation-result-name").contains(":)")
    });
    it('Test old functionality: not existing', () => {
        cy.visit(`${basePath}/people`);
        cy.get("#name").type("neegzistuojantis");
        cy.wait(second);
        cy.get("#validation-result-name").contains(":(")
    });
    it('Test new functionality: happy case', () => {
        cy.visit(`${basePath}/people`);
        cy.get("#team").type("devcollab");
        cy.wait(second);
        cy.get("#validation-result-team").contains(":)");
        cy.screenshot();
    });
    it('Test new functionality: not existing', () => {
        cy.visit(`${basePath}/people`);
        cy.get("#team").type("neegzistuojanti");
        cy.wait(second);
        cy.get("#validation-result-team").contains(":(");
        cy.screenshot();
    });
});
