<?php

/*******************************************************************************
 * The MIT License (MIT)
 * 
 * Copyright (c) 2014 Jean-David Gadina - www-xs-labs.com
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 ******************************************************************************/

/* $Id$ */

require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'Member.class.php';

class XS_Docset_ClassMember extends XS_Docset_Member
{
    protected $_class = NULL;
    
    public function __construct( XS_Docset_Class $class, SimpleXMLElement $xml )
    {
        parent::__construct( $xml );
        
        $this->_class = $class;
    }
    
    public function getAccessControl()
    {
        if( isset( $this->_xml[ 'accessControl' ] ) && ( string )( $this->_xml[ 'accessControl' ] ) === 'protected' )
        {
            return 'protected';
        }
        
        if( isset( $this->_xml[ 'accessControl' ] ) && ( string )( $this->_xml[ 'accessControl' ] ) === 'private' )
        {
            return 'private';
        }
        
        return 'public';
    }
    
    public function getNotes()
    {
        if( $this->getAccessControl() === 'protected' )
        {
            return 'This member is protected.';
        }
        
        if( $this->getAccessControl() === 'private' )
        {
            return 'This member is private.';
        }
        
        return parent::getNotes();
    }
}
