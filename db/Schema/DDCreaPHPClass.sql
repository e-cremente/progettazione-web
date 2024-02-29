USE adndproject;

DROP PROCEDURE IF EXISTS adndproject.DDCreaPHPClass;

delimiter //
CREATE DEFINER=root@localhost PROCEDURE adndproject.DDCreaPHPClass(
pTableSchema varchar(64),
pTableName varchar(64)
)
COMMENT 'Crea la classe PHP per la tabella di database pTableSchema.pTableName'
BEGIN
    DECLARE lvCLS longtext;
    DECLARE lvNL char(2) default CHAR(10 using utf8);
    DECLARE lvSEP char(1) default '';
    DECLARE lvTABLE_SCHEMA varchar(64);
    DECLARE lvTABLE_NAME varchar(64);
    DECLARE lvCOLUMN_NAME varchar(64);
    DECLARE lvORDINAL_POSITION bigint unsigned;
    DECLARE lvCOLUMN_DEFAULT longtext;
    DECLARE lvIS_NULLABLE varchar(3);
    DECLARE lvDATA_TYPE varchar(64);
    DECLARE lvCHARACTER_MAXIMUM_LENGTH bigint unsigned;
    DECLARE lvNUMERIC_PRECISION bigint unsigned;
    DECLARE lvNUMERIC_SCALE bigint unsigned;
    DECLARE lvCOLUMN_TYPE longtext;
    DECLARE lvCOLUMN_KEY varchar(3);
    --
    DECLARE lvCONSTRAINT_SCHEMA varchar(64);
    DECLARE lvCONSTRAINT_NAME varchar(64);
    DECLARE lvREF_TABLE_NAME varchar(64);
    DECLARE lvREF_COLUMN_NAME varchar(64);
    DECLARE lvREFERENCED_TABLE_NAME varchar(64);
    DECLARE lvREFERENCED_COLUMN_NAME varchar(64);
    DECLARE lvREFERENCED_CLASS varchar(64);
    -- 
    DECLARE lvEOF INTEGER DEFAULT 0;
    declare cCols cursor for
    select C.TABLE_SCHEMA,
           C.TABLE_NAME,
           C.COLUMN_NAME,
           C.ORDINAL_POSITION,
           C.COLUMN_DEFAULT,
           C.IS_NULLABLE,
           C.DATA_TYPE,
           C.CHARACTER_MAXIMUM_LENGTH,
           C.NUMERIC_PRECISION,
           C.NUMERIC_SCALE,
           C.COLUMN_TYPE,
           C.COLUMN_KEY
      from INFORMATION_SCHEMA.COLUMNS C
     where C.TABLE_SCHEMA = pTableSchema
       and C.TABLE_NAME = pTableName
      order by C.ORDINAL_POSITION
    ;
    declare cRefs cursor for
    select R.constraint_name, R.referenced_table_name
      from INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS R
     where R.constraint_schema = pTableSchema
       and R.table_name = pTableName
    ;
    declare cRefCols cursor for
    select C.column_name, C.referenced_column_name
      from INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS R
           inner join INFORMATION_SCHEMA.KEY_COLUMN_USAGE C on (
               C.constraint_schema = R.constraint_schema
               and C.constraint_name = R.constraint_name
               and C.table_name = R.table_name
           )
     where R.constraint_schema = pTableSchema
       and R.constraint_name = lvCONSTRAINT_NAME
       and R.referenced_table_name = lvREFERENCED_TABLE_NAME
       and R.table_name = pTableName
    ;
    DECLARE CONTINUE HANDLER FOR NOT FOUND set lvEOF = 1;
    --
    -- CLASS DECLARATION
    set lvCLS = '<?php';
    set lvCLS = concat(lvCLS, lvNL, '    class cls', pTableName, ' {');
    set lvCLS = concat(lvCLS, lvNL, '        //Proprietà private');
    --
    OPEN cCols;
    fetch cCols into lvTABLE_SCHEMA, lvTABLE_NAME, lvCOLUMN_NAME,
        lvORDINAL_POSITION, lvCOLUMN_DEFAULT, lvIS_NULLABLE,
        lvDATA_TYPE, lvCHARACTER_MAXIMUM_LENGTH, lvNUMERIC_PRECISION,
        lvNUMERIC_SCALE, lvCOLUMN_TYPE, lvCOLUMN_KEY;
    WHILE NOT lvEOF do
        set lvCLS = concat(lvCLS, lvNL, '        private $m_', lvCOLUMN_NAME, ';');
        --
        fetch cCols into lvTABLE_SCHEMA, lvTABLE_NAME, lvCOLUMN_NAME,
            lvORDINAL_POSITION, lvCOLUMN_DEFAULT, lvIS_NULLABLE,
            lvDATA_TYPE, lvCHARACTER_MAXIMUM_LENGTH, lvNUMERIC_PRECISION,
            lvNUMERIC_SCALE, lvCOLUMN_TYPE, lvCOLUMN_KEY;
    END WHILE;
    CLOSE cCols;
    --
    set lvCLS = concat(lvCLS, lvNL, '        //RELAZIONI: PADRI');
    set lvEOF = 0;
    OPEN cRefs;
    fetch cRefs into lvCONSTRAINT_NAME, lvREFERENCED_TABLE_NAME;
    WHILE NOT lvEOF do
        set lvCLS = concat(lvCLS, lvNL, '        private $m_', lvREFERENCED_TABLE_NAME, ';');
        fetch cRefs into lvCONSTRAINT_NAME, lvREFERENCED_TABLE_NAME;
    END WHILE;
    CLOSE cRefs;
    --
    set lvCLS = concat(lvCLS, lvNL, '        //RELAZIONI: FIGLI');
    set lvCLS = concat(lvCLS, lvNL, '');
    set lvCLS = concat(lvCLS, lvNL, '        //Proprietà pubbliche');
    set lvCLS = concat(lvCLS, lvNL, '        // funzioni magiche __get, __set {{{');
    set lvCLS = concat(lvCLS, lvNL, '        public function __set($pProperty, $pValue)');
    set lvCLS = concat(lvCLS, lvNL, '        {');
    set lvCLS = concat(lvCLS, lvNL, '            $lvAttribute = "m_".$pProperty;');
    set lvCLS = concat(lvCLS, lvNL, '            if (property_exists(__CLASS__, $lvAttribute)) {');
    set lvCLS = concat(lvCLS, lvNL, '                $this->$lvAttribute = $pValue;');
    set lvCLS = concat(lvCLS, lvNL, '                return;');
    set lvCLS = concat(lvCLS, lvNL, '            }');
    set lvCLS = concat(lvCLS, lvNL, '            if (lib\\util::hasParent($this)) {');
    set lvCLS = concat(lvCLS, lvNL, '                parent::__set($pProperty, $pValue);');
    set lvCLS = concat(lvCLS, lvNL, '                return;');
    set lvCLS = concat(lvCLS, lvNL, '            }');
    set lvCLS = concat(lvCLS, lvNL, '            throw new \\Exception("setProperty: {$pProperty} not found in ".__CLASS__);');
    set lvCLS = concat(lvCLS, lvNL, '        }');
    set lvCLS = concat(lvCLS, lvNL, '');
    set lvCLS = concat(lvCLS, lvNL, '        public function __get($pProperty)');
    set lvCLS = concat(lvCLS, lvNL, '        {');
    set lvCLS = concat(lvCLS, lvNL, '            //RELAZIONI: PADRI');
    set lvEOF = 0;
    OPEN cRefs;
    fetch cRefs into lvCONSTRAINT_NAME, lvREFERENCED_TABLE_NAME;
    WHILE NOT lvEOF do
        set lvSEP = '';
        set lvREFERENCED_CLASS = lvREFERENCED_TABLE_NAME;
        set lvCLS = concat(lvCLS, lvNL, '            if ($pProperty == ''', lvREFERENCED_CLASS, ''') {');
        set lvCLS = concat(lvCLS, lvNL, '                if ($this->m_', lvREFERENCED_CLASS, ' == null) {');
        set lvCLS = concat(lvCLS, lvNL, '                    $this->m_', lvREFERENCED_CLASS, ' = new cls', lvREFERENCED_CLASS, '(dal\\DB_Sel', lvREFERENCED_CLASS, '(');
        OPEN cRefCols;
        fetch cRefCols into lvREF_COLUMN_NAME, lvREFERENCED_COLUMN_NAME;
        while NOT lvEOF do
            set lvCLS = concat(lvCLS, lvSEP, '$this->m_', lvREF_COLUMN_NAME);
            set lvSEP = ',';
            fetch cRefCols into lvREF_COLUMN_NAME, lvREFERENCED_COLUMN_NAME;
        END WHILE;
        CLOSE cRefCols;
        set lvCLS = concat(lvCLS, '));');
        set lvCLS = concat(lvCLS, lvNL, '                }');
        set lvCLS = concat(lvCLS, lvNL, '                return $this->m_', lvREFERENCED_CLASS, ';');
        set lvCLS = concat(lvCLS, lvNL, '            }');
        set lvEOF = 0;
        fetch cRefs into lvCONSTRAINT_NAME, lvREFERENCED_TABLE_NAME;
    END WHILE;
    CLOSE cRefs;
    --
    set lvCLS = concat(lvCLS, lvNL, '            //ALTRE PROPRIETA');
    set lvCLS = concat(lvCLS, lvNL, '            $lvAttribute = "m_".$pProperty;');
    set lvCLS = concat(lvCLS, lvNL, '            if (property_exists(__CLASS__, $lvAttribute)) {');
    set lvCLS = concat(lvCLS, lvNL, '                return $this->$lvAttribute;');
    set lvCLS = concat(lvCLS, lvNL, '            }');
    set lvCLS = concat(lvCLS, lvNL, '            if (lib\\util::hasParent($this)) {');
    set lvCLS = concat(lvCLS, lvNL, '                return parent::__get($pProperty);');
    set lvCLS = concat(lvCLS, lvNL, '            }');
    set lvCLS = concat(lvCLS, lvNL, '            throw new \\Exception("getProperty: {$pProperty} not found in ".__CLASS__);');
    set lvCLS = concat(lvCLS, lvNL, '        }');
    set lvCLS = concat(lvCLS, lvNL, '        // }}}');
    set lvCLS = concat(lvCLS, lvNL, '');
    set lvCLS = concat(lvCLS, lvNL, '        // public function __construct($pDBRow = null, $pPrfx = '''') {{{');
    set lvCLS = concat(lvCLS, lvNL, '        public function __construct($pDBRow = null, $pPrfx = '''')');
    set lvCLS = concat(lvCLS, lvNL, '        {');
    set lvCLS = concat(lvCLS, lvNL, '            if ($pDBRow == null) return;');
    set lvEOF = 0;
    OPEN cCols;
    fetch cCols into lvTABLE_SCHEMA, lvTABLE_NAME, lvCOLUMN_NAME,
        lvORDINAL_POSITION, lvCOLUMN_DEFAULT, lvIS_NULLABLE,
        lvDATA_TYPE, lvCHARACTER_MAXIMUM_LENGTH, lvNUMERIC_PRECISION,
        lvNUMERIC_SCALE, lvCOLUMN_TYPE, lvCOLUMN_KEY;
    WHILE NOT lvEOF do
        set lvCLS = concat(lvCLS, lvNL, '            $this->m_', lvCOLUMN_NAME, ' = $pDBRow["{$pPrfx}', lvCOLUMN_NAME, '"];');
        --
        fetch cCols into lvTABLE_SCHEMA, lvTABLE_NAME, lvCOLUMN_NAME,
            lvORDINAL_POSITION, lvCOLUMN_DEFAULT, lvIS_NULLABLE,
            lvDATA_TYPE, lvCHARACTER_MAXIMUM_LENGTH, lvNUMERIC_PRECISION,
            lvNUMERIC_SCALE, lvCOLUMN_TYPE, lvCOLUMN_KEY;
    END WHILE;
    CLOSE cCols;
    set lvCLS = concat(lvCLS, lvNL, '        }');
    set lvCLS = concat(lvCLS, lvNL, '        // }}}');
    set lvCLS = concat(lvCLS, lvNL, '');
    set lvCLS = concat(lvCLS, lvNL, '        // public function toArray() {{{');
    set lvCLS = concat(lvCLS, lvNL, '        public function toArray()');
    set lvCLS = concat(lvCLS, lvNL, '        {');
    set lvCLS = concat(lvCLS, lvNL, '            $lvRes = [');
    set lvEOF = 0;
    OPEN cCols;
    fetch cCols into lvTABLE_SCHEMA, lvTABLE_NAME, lvCOLUMN_NAME,
        lvORDINAL_POSITION, lvCOLUMN_DEFAULT, lvIS_NULLABLE,
        lvDATA_TYPE, lvCHARACTER_MAXIMUM_LENGTH, lvNUMERIC_PRECISION,
        lvNUMERIC_SCALE, lvCOLUMN_TYPE, lvCOLUMN_KEY;
    WHILE NOT lvEOF do
        set lvCLS = concat(lvCLS, lvNL, '                ''', lvCOLUMN_NAME, '''=>$this->m_', lvCOLUMN_NAME, ',');
        --
        fetch cCols into lvTABLE_SCHEMA, lvTABLE_NAME, lvCOLUMN_NAME,
            lvORDINAL_POSITION, lvCOLUMN_DEFAULT, lvIS_NULLABLE,
            lvDATA_TYPE, lvCHARACTER_MAXIMUM_LENGTH, lvNUMERIC_PRECISION,
            lvNUMERIC_SCALE, lvCOLUMN_TYPE, lvCOLUMN_KEY;
    END WHILE;
    set lvCLS = concat(lvCLS, lvNL, '            ];');
    set lvCLS = concat(lvCLS, lvNL, '            return $lvRes;');
    set lvCLS = concat(lvCLS, lvNL, '        }');
    set lvCLS = concat(lvCLS, lvNL, '        // }}}');
   
    set lvCLS = concat(lvCLS, lvNL, '');
    set lvCLS = concat(lvCLS, lvNL, '    }');
    set lvCLS = concat(lvCLS, lvNL, '?>');
    select lvCLS;
END;
//
delimiter ;
