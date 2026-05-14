-- Demo seed para InfinityFree / HeidiSQL
-- Antes de ejecutar: haz una copia de seguridad si ya tienes datos.
-- Este script limpia tablas funcionales y vuelve a insertar datos de prueba.

START TRANSACTION;

SET FOREIGN_KEY_CHECKS = 0;

DELETE FROM personal_access_tokens;
DELETE FROM medications;
DELETE FROM treatments;
DELETE FROM diagnostics;
DELETE FROM cites;
DELETE FROM pacients;
DELETE FROM medics;
DELETE FROM users;

ALTER TABLE users AUTO_INCREMENT = 1;
ALTER TABLE pacients AUTO_INCREMENT = 1;
ALTER TABLE medics AUTO_INCREMENT = 1;
ALTER TABLE cites AUTO_INCREMENT = 1;
ALTER TABLE diagnostics AUTO_INCREMENT = 1;
ALTER TABLE treatments AUTO_INCREMENT = 1;
ALTER TABLE medications AUTO_INCREMENT = 1;
ALTER TABLE personal_access_tokens AUTO_INCREMENT = 1;

SET FOREIGN_KEY_CHECKS = 1;

-- Credenciales demo:
-- admin / admin12345
-- avegam / paciente123
-- ltorresr / paciente123
-- cperezs / paciente123

INSERT INTO users (
    id,
    name,
    username,
    email,
    google_id,
    github_id,
    auth_provider,
    avatar_url,
    email_verified_at,
    password,
    remember_token,
    role,
    created_at,
    updated_at
) VALUES
    (
        1,
        'Administrador',
        'admin',
        'admin@sanar.local',
        NULL,
        NULL,
        NULL,
        NULL,
        NOW(),
        '$2y$10$.t.s0T1jPYJyJxado21it.nvNC5CRFTRfDGvIOdKHLSraJZpWfGLO',
        NULL,
        'admin',
        NOW(),
        NOW()
    ),
    (
        2,
        'Andre Vega Minaya',
        'avegam',
        'avegam@paciente.local',
        NULL,
        NULL,
        NULL,
        NULL,
        NOW(),
        '$2y$10$4i.w2Mjyy0BckrGNf1DSFevMufE1GfqcxEJW4Y7og4dOWUVbkO2Yu',
        NULL,
        'patient',
        NOW(),
        NOW()
    ),
    (
        3,
        'Lucia Torres Rojas',
        'ltorresr',
        'ltorresr@paciente.local',
        NULL,
        NULL,
        NULL,
        NULL,
        NOW(),
        '$2y$10$4i.w2Mjyy0BckrGNf1DSFevMufE1GfqcxEJW4Y7og4dOWUVbkO2Yu',
        NULL,
        'patient',
        NOW(),
        NOW()
    ),
    (
        4,
        'Carlos Perez Salas',
        'cperezs',
        'cperezs@paciente.local',
        NULL,
        NULL,
        NULL,
        NULL,
        NOW(),
        '$2y$10$4i.w2Mjyy0BckrGNf1DSFevMufE1GfqcxEJW4Y7og4dOWUVbkO2Yu',
        NULL,
        'patient',
        NOW(),
        NOW()
    );

INSERT INTO pacients (
    id_pacient,
    user_id,
    nombre,
    apellido,
    fecha_nacimiento,
    genero,
    telefono,
    direccion,
    tipo_sangre,
    created_at,
    updated_at
) VALUES
    (
        1,
        2,
        'Andre',
        'Vega Minaya',
        '2000-01-15',
        'Masculino',
        '987654321',
        'Av. Los Cedros 145, Lima',
        'O+',
        NOW(),
        NOW()
    ),
    (
        2,
        3,
        'Lucia',
        'Torres Rojas',
        '1998-06-21',
        'Femenino',
        '976543210',
        'Jr. Primavera 820, Lima',
        'A+',
        NOW(),
        NOW()
    ),
    (
        3,
        4,
        'Carlos',
        'Perez Salas',
        '1992-11-03',
        'Masculino',
        '965432109',
        'Calle Central 458, Lima',
        'B+',
        NOW(),
        NOW()
    );

INSERT INTO medics (
    id_medic,
    nombre,
    apellido,
    especialidad,
    telefono,
    email,
    licencia,
    anios_experiencia,
    created_at,
    updated_at
) VALUES
    (
        1,
        'Sofia',
        'Quispe',
        'Medicina General',
        '900111222',
        'sofia.quispe@sanar.local',
        'CMP-1001',
        9,
        NOW(),
        NOW()
    ),
    (
        2,
        'Mario',
        'Perez',
        'Cardiologia',
        '900222333',
        'mario.perez@sanar.local',
        'CMP-1002',
        12,
        NOW(),
        NOW()
    ),
    (
        3,
        'Elena',
        'Ruiz',
        'Dermatologia',
        '900333444',
        'elena.ruiz@sanar.local',
        'CMP-1003',
        11,
        NOW(),
        NOW()
    );

INSERT INTO diagnostics (
    id_diagnostic,
    descripcion,
    fecha,
    id_pacient,
    id_medic,
    gravedad,
    recomendaciones,
    tipo_diagnostico,
    created_at,
    updated_at
) VALUES
    (
        1,
        'Resfriado comun con irritacion de garganta y malestar general.',
        '2026-05-10 09:30:00',
        1,
        1,
        'Leve',
        'Reposo, hidratacion y control en 5 dias.',
        'Clinico',
        NOW(),
        NOW()
    ),
    (
        2,
        'Palpitaciones frecuentes asociadas a estres y sobrecarga laboral.',
        '2026-05-11 11:00:00',
        2,
        2,
        'Media',
        'Electrocardiograma, descanso y seguimiento cardiologico.',
        'Especializado',
        NOW(),
        NOW()
    ),
    (
        3,
        'Dermatitis atopica con enrojecimiento y picazon persistente.',
        '2026-05-12 16:15:00',
        3,
        3,
        'Media',
        'Uso de crema topica y control dermatologico en 2 semanas.',
        'Clinico',
        NOW(),
        NOW()
    );

INSERT INTO treatments (
    id_treatment,
    nombre,
    descripcion,
    duracion,
    id_diagnostic,
    id_medic,
    estado,
    frecuencia_administracion,
    created_at,
    updated_at
) VALUES
    (
        1,
        'Tratamiento para resfriado',
        'Plan de manejo sintomatico con control ambulatorio.',
        '5 dias',
        1,
        1,
        'Activo',
        'Cada 8 horas',
        NOW(),
        NOW()
    ),
    (
        2,
        'Control cardiologico inicial',
        'Seguimiento de sintomas, examen y control de signos.',
        '30 dias',
        2,
        2,
        'Activo',
        'Una vez por semana',
        NOW(),
        NOW()
    ),
    (
        3,
        'Tratamiento dermatologico topico',
        'Aplicacion de crema y medidas de cuidado de la piel.',
        '14 dias',
        3,
        3,
        'Activo',
        'Cada 12 horas',
        NOW(),
        NOW()
    );

INSERT INTO medications (
    id_medication,
    nombre,
    dosis,
    frecuencia,
    duracion,
    id_treatment,
    proveedor,
    efectos_secundarios,
    created_at,
    updated_at
) VALUES
    (
        1,
        'Paracetamol',
        '500 mg',
        'Cada 8 horas',
        '5 dias',
        1,
        'Botica Central',
        'Somnolencia leve',
        NOW(),
        NOW()
    ),
    (
        2,
        'Propranolol',
        '20 mg',
        'Cada 24 horas',
        '30 dias',
        2,
        'Farmacia Salud',
        'Mareo ocasional',
        NOW(),
        NOW()
    ),
    (
        3,
        'Hidrocortisona crema',
        'Aplicacion topica',
        'Cada 12 horas',
        '14 dias',
        3,
        'Dermacare',
        'Irritacion temporal',
        NOW(),
        NOW()
    );

INSERT INTO cites (
    id_cita,
    fecha,
    motivo,
    id_pacient,
    id_medic,
    estado,
    observaciones,
    sala,
    created_at,
    updated_at
) VALUES
    (
        1,
        '2026-06-20 08:00:00',
        'Chequeo general por resfriado',
        1,
        1,
        'Confirmada',
        'Paciente debe llegar 15 minutos antes.',
        'Consultorio 1',
        NOW(),
        NOW()
    ),
    (
        2,
        '2026-06-22 10:30:00',
        'Control de palpitaciones',
        2,
        2,
        'Pendiente',
        'Traer resultados de analisis previos.',
        'Consultorio 3',
        NOW(),
        NOW()
    ),
    (
        3,
        '2026-06-25 15:00:00',
        'Revision dermatologica',
        3,
        3,
        'Confirmada',
        'Evitar uso de cremas ajenas antes de la consulta.',
        'Consultorio 5',
        NOW(),
        NOW()
    );

COMMIT;
