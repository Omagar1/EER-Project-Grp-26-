
DROP TABLE IF EXISTS account;
CREATE TABLE account (
    accountID INTEGER PRIMARY KEY AUTO_INCREMENT,
    emailAddress VARCHAR(255) NOT NULL,
    verifyEmail BOOLEAN NOT NULL DEFAULT false,
    `password` VARCHAR(255) NOT NULL,
    dateCreated DATE NOT NULL,
    `role`VARCHAR(255) NOT NULL,
    active BOOLEAN NOT NULL DEFAULT true
);
DROP TABLE IF EXISTS property;
CREATE TABLE property (
    propertyID INTEGER PRIMARY KEY AUTO_INCREMENT,
    ownerID INTEGER NOT NULL,
    EER CHAR NOT NULL,
    `postcode` VARCHAR(255) NOT NULL, -- Presumptive
    `address` VARCHAR(255) NOT NULL, -- Presumptive
    `reportIssueDate` DATE NOT NULL, -- Presumptive
    certificateNumber VARCHAR(255) NOT NULL -- Presumptive
);
DROP TABLE IF EXISTS equation;
CREATE TABLE equation (
    equationID INTEGER PRIMARY KEY AUTO_INCREMENT,
    equation VARCHAR(255) NOT NULL
);
DROP TABLE IF EXISTS userSavedProperty;
CREATE TABLE userSavedProperty (
    ID INTEGER PRIMARY KEY AUTO_INCREMENT,
    userID INTEGER,
    propertyID INTEGER
);
DROP TABLE IF EXISTS recommendation;
CREATE TABLE recommendation ( 
    recommendationID INTEGER PRIMARY KEY AUTO_INCREMENT, 
    propertyID INTEGER NOT NULL, 
    `carbonEmistionsImpact` VARCHAR(255) NOT NULL, 
    `recomendedChanges` VARCHAR(255) NOT NULL
);
