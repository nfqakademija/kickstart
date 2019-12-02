const basePath = Cypress.env('BASE_URL') ? Cypress.env('BASE_URL') : 'http://127.0.0.1:8000/';

const d = async (message) => {
    console.info('D', message);
    await cy.ciDebug(message);
};
const dd = async (message) => {
    console.log('DD', message);
    await cy.ciLog(message);
};

describe('First homework', function() {
    it('Have students block', () => {
        cy.visit(basePath);
        cy.contains("Studentai")
            .parent()
            .children('.list-group-item:not(.list-group-item-info)')
            .then(data => data.map((index, element) => element.innerText).get())
            .then(students => {
                cy.wrap(students).each(student => dd(`Student: ${student}`));
            }).then( students => {
                assert.equal(students.length, 51, "Expected 51 elements of students");
            }).then( students => {
                cy.wrap(students).each(e => {
                    expect(e).contain("Mentorius");
                })
            });

        cy.contains("Studentai").parent().screenshot();
    });
    it('Have correct students-mentor data', () => {
        cy.visit(basePath);
        cy.contains("Studentai")
            .parent()
            .children('.list-group-item:not(.list-group-item-info)')
            .first()
            .contains("Tadas")
            .parent()
            .contains("Mantas");
    });

    it('Have project block', () => {
        cy.visit(basePath);
        cy.contains("Projektai").parent().screenshot();
    });

    it('Have form block', () => {
        cy.visit(basePath);
        cy.contains("Sužinoti vertinimą").parent().screenshot();
    });

    it('Whole page', () => {
        cy.visit(basePath);
        cy.screenshot();
    });

    it('Click on first student', () => {
        cy.visit(basePath);
        cy.contains("Studentai")
            .parent()
            .children('.list-group-item:not(.list-group-item-info)')
            .first().children('a').click();

        d("Expected inner page");
        cy.contains("Studentas");
        cy.contains("Projektas");
        cy.screenshot();

        cy.contains("Visi studentai").click()
    });

    it('Click on Data file', () => {
        cy.visit(basePath);
        cy.contains("Duomenų failas").then( a => {
            const link = a.attr('href');
            cy.wrap([link]).each(link => dd(`Data file link: ${link}`))
        }).then( links => {
            const link = links[0];
            expect(link).to.eq("students.json");
        })
    });

    it('Have properly escaped student', () => {
        cy.visit(basePath);
        cy.contains("Studentai")
            .parent()
            .children()
            .last()
            .contains(`<b>Ir</b> jo "geras" draug'as`)
            .then( element => {
                const link = element.get(0).href;
                dd(`Actual link: ${link}`);
                const expected1 = '?name=%3Cb%3EIr%3C/b%3E%20jo%20%22geras%22%20draug%27as&project=hack%3Cb%3Eer%3C/b%3E%27is%20po%20.mySubdomain%20%26project%3D123'; // Generated with path
                const expected2 = '?name=%3Cb%3EIr%3C%2Fb%3E%20jo%20%22geras%22%20draug%27as&project=hack%3Cb%3Eer%3C%2Fb%3E%27is%20po%20.mySubdomain%20%26project%3D123'; // Generated with url_encode
                dd(`Expected end: ${expected1}`);
                assert(
                    link.endsWith(expected1) || expected2,
                    `Expected url_encode Twig filter: actual: \n${link}\n does not ends with \n${expected1}\n ` +
                    `See https://symfony.com/doc/4.2/templating.html#linking-to-pages and ` +
                    `https://twig.symfony.com/doc/2.x/filters/url_encode.html`
                );
            })
    });

    it('Have properly escaped Projektai', () => {
        cy.visit(basePath);
        cy.contains("Projektai")
            .parent()
            .children()
            .last().
            contains(`' OR 1 -- DROP DATABASE`)
            .parent()
            .contains(`github.com/nfqakademija/hack<b>er</b>'is po .mySubdomain &project=123`)
            .parent()
            .parent()
            .contains(`hack<b>er</b>'is po .mySubdomain &project=123.projektai.nfqakademija.lt/`)
            .then( element => {
                const link = element.get(0).href;
                dd(`Actual link:   ${link}`);
                const expected = `http://hack%3Cb%3Eer%3C%2Fb%3E%27is%20po%20.mysubdomain%20%26project%3D123.projektai.nfqakademija.lt/`;
                dd(`Expected link: ${expected}`);
                expect(link).to.eq(expected);
                cy.wrap(element); // Because asynchronous in cypress works a bit different
            })
            .parent()
            .parent()
            .contains(`ssh hack<b>er</b>'is po .mySubdomain &project=123@deploy.nfqakademija.lt -p 2222`)
    });

    it('Have correct person with good evaluation', () => {
        cy.visit(basePath);
        cy.contains("Studentai")
            .parent()
            .children('.list-group-item:not(.list-group-item-info)')
            .children("a")
            .then( elements => {
                cy.wrap(elements).each(element => {
                    let path = element.get(0).href;
                    cy.visit(path).get('.alert, .success').then( data => {
                        if (data.get(0).innerText === 'Dešimt balų') {
                            cy.screenshot();
                            cy.wrap([path]).each( path => {
                                dd(`Įvertinti: ${path}`);
                            });

                        }
                    });
                });
            });
    });
});
