
DROP TABLE IF EXISTS account;
CREATE TABLE account (
    accountID INTEGER PRIMARY KEY AUTO_INCREMENT,
    emailAddress VARCHAR(255) NOT NULL,
    verifyEmail BOOLEAN NOT NULL DEFAULT false,
    emailChanged DATETIME NOT NULL, -- when first created is the same time as date created
    emailChangedBy INTEGER NOT NULL, -- foreign key refference account ID
    `password` VARCHAR(255) NOT NULL,
    dateCreated DATE NOT NULL,
    `role`VARCHAR(255) NOT NULL,
    active BOOLEAN NOT NULL DEFAULT true
);
DROP TABLE IF EXISTS property;
CREATE TABLE property (
    propertyID INTEGER PRIMARY KEY AUTO_INCREMENT,
    ownerID INTEGER NOT NULL, -- foreign key refference account ID
    EER CHAR NOT NULL, 
    `postcode` VARCHAR(255) NOT NULL, -- Presumptive
    `address` VARCHAR(255) NOT NULL, -- Presumptive
    addressChanged DATETIME NOT NULL, -- when first created is the same time as date created
    postcodeChangedBy INTEGER NOT NULL, -- foreign key refference account ID
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
    userID INTEGER, -- foreign key refference account ID
    propertyID INTEGER -- foreign key refference property ID
);
DROP TABLE IF EXISTS recommendation;
CREATE TABLE recommendation ( 
    recommendationID INTEGER PRIMARY KEY AUTO_INCREMENT, 
    propertyID INTEGER NOT NULL, -- foreign key refference property ID 
    `carbonEmistionsImpact` VARCHAR(255) NOT NULL, 
    `recomendedChanges` VARCHAR(255) NOT NULL
);
 