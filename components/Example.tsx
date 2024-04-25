import React from 'react';

// This folder is for globally shared components. Remove this example component later

const Example = ({ children = 'hi' }: { children?: React.ReactNode }) => {
  return <div>{children}</div>;
};

export default Example;
