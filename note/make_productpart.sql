CREATE TABLE product (
    id SERIAL PRIMARY KEY,
    code VARCHAR(20) UNIQUE NOT NULL,
    name VARCHAR(255) UNIQUE NOT NULL,
    introductiondate DATE,
    salesdiscontinuationdate DATE,
    comment VARCHAR(255),
    producttype VARCHAR(20)
);

CREATE TABLE productcomponent (
    id SERIAL PRIMARY KEY,
    code VARCHAR(20),
    fromdate DATE,
    thrudate DATE,
    quantityuse INTEGER,
    instruction VARCHAR(255),
    comment VARCHAR(255),
    parentproductid INTEGER REFERENCES product(id) ON DELETE CASCADE,
    componentproductid INTEGER REFERENCES product(id) ON DELETE CASCADE
);


-- Insert mock data into 'product'
INSERT INTO product (code, name, introductiondate, salesdiscontinuationdate, comment, producttype) VALUES
('P001', 'Widget A', '2023-01-01', '2025-12-31', 'Popular widget', 'Type1'),
('P002', 'Gadget B', '2022-05-15', NULL, 'High demand gadget', 'Type2'),
('P003', 'Device C', '2021-09-10', NULL, 'Reliable device', 'Type1'),
('P004', 'Widget D', '2023-02-20', '2024-08-30', 'Discontinued model', 'Type3'),
('P005', 'Gadget E', '2023-06-01', NULL, 'Newest in series', 'Type2'),
('P006', 'Device F', '2021-12-05', NULL, 'Multi-purpose device', 'Type3'),
('P007', 'Widget G', '2020-04-12', '2023-07-01', 'Old but durable', 'Type1'),
('P008', 'Gadget H', '2023-08-18', NULL, 'Special edition', 'Type2');

-- Insert mock data into 'productcomponent'
INSERT INTO productcomponent (code, fromdate, thrudate, quantityuse, instruction, comment, parentproductid, componentproductid) VALUES
('C001', '2023-01-01', '2024-01-01', 10, 'Attach carefully', 'Core component', 1, 2),
('C002', '2023-02-01', '2024-12-31', 5, 'Use screws', 'Assembly required', 1, 3),
('C003', '2022-05-15', NULL, 2, 'Align precisely', 'Important for stability', 2, 4),
('C004', '2021-09-10', NULL, 1, 'Glue together', 'Stable assembly', 3, 5),
('C005', '2023-06-01', NULL, 3, 'Tighten bolts', 'Ensure no loose parts', 5, 6),
('C006', '2021-12-05', '2024-05-05', 4, 'Follow manual', 'Replacement part', 6, 7),
('C007', '2020-04-12', NULL, 6, 'Attach with care', 'Heavy component', 7, 8),
('C008', '2023-08-18', NULL, 8, 'Secure firmly', 'Critical for performance', 8, 1),
('C009', '2021-10-10', '2022-10-10', 9, 'Use adhesives', 'Requires precision', 2, 3),
('C010', '2023-01-15', NULL, 7, 'Fix with screws', 'Integral part', 4, 5);

-- Additional mock data to fill 'productcomponent'
INSERT INTO productcomponent (code, fromdate, thrudate, quantityuse, instruction, comment, parentproductid, componentproductid) VALUES
('C011', '2023-06-18', NULL, 2, 'Use tape', 'Temporary attachment', 5, 2),
('C012', '2022-07-12', '2023-07-12', 5, 'Use glue', 'High adhesive required', 7, 3),
('C013', '2020-04-01', NULL, 3, 'Bolt on', 'Keep tight', 6, 4),
('C014', '2021-11-23', NULL, 6, 'Use clamp', 'Hold firmly', 3, 8),
('C015', '2023-03-15', NULL, 10, 'Align perfectly', 'Stability is key', 8, 6);
